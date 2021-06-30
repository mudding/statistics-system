<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\model\entity\Account;
use app\model\entity\Order;
use app\model\entity\OrderRelation;
use app\model\entity\SignalTime;
use app\model\entity\Variety;
use app\modules\order\dao\AccountDao;
use app\modules\order\dao\OrderDao;
use app\modules\order\dao\OrderRelationDao;
use app\modules\order\vo\OrderCreateVo;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\bean\BeanUtil;
use app\utils\order\OrderHelper;
use Carbon\Carbon;
use framework\db\DB;
use framework\string\StringUtils;
use framework\util\Loader;

class OrderService
{
    /** @var OrderDao $dao */
    private $dao;

    /**
     * OrderService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(OrderDao::class);
    }

    /**
     * 总数据 = 账户信息+首单+加仓单
     *
     * @param $accountId
     * @param $orderId
     * @return mixed
     */
    public function details($accountId, $orderId)
    {
        $data['account'] = AccountService::getAccountToOrder($accountId);
        /** @var Order $supOrder */
        $supOrder = $this->dao->getById($orderId);
        if (!empty($supOrder)) {
            $data['supOrder'] = $this->getOrderData($supOrder);
            //查询加仓单数据
            $subOrder = $supOrder->orderRelation()->paginate();
            /** @var OrderRelation $sub */
            foreach ($subOrder as $k => $sub) {
                $data['subOrder'][$k] = $sub->getSubOrder()->first();
            }
        }
        return $data;
    }

    /**
     * 单条订单数据 = 账户信息+单条数据
     *
     * @param $accountId
     * @param $orderId
     * @return mixed
     */
    public function getById($accountId, $orderId)
    {
        $data['account'] = AccountService::getAccountToOrder($accountId);
        /** @var Order $order */
        $order = $this->dao->getById($orderId);
        if (!empty($order)) {
            $data['order'] = $this->getOrderData($order);
        }
        return $data;
    }

    /**
     * 统一处理订单数据
     *
     * @param Order $order
     * @return array
     */
    private function getOrderData(Order $order)
    {
        /** @var Variety $variety */
        $variety = $order->variety()->first();
        /** @var SignalTime $signalTime */
        $signalTime = $order->signalTime()->first();
        return [
            'id' => $order->getOriginal('id'),
            'no' => $order->no,
            'direction' => $order->direction,
            'directionName' => Order::ORDER_DIRECTION[$order->direction],
            'orderType' => $order->order_type,
            'orderTypeName' => Order::ORDER_TYPE[$order->order_type],
            'orderStatus' => $order->order_status,
            'orderStatusName' => Order::ORDER_STATUS[$order->order_status],
            //品种id
            'varietyId' => $order->variety_id,
            'varietyName' => $variety->variety_name,
            //信号周期查询
            'inputSignalTimeId' => $order->input_signal_time_id,
            'inputSignalTimeName' => $signalTime->signal_time_name,

            'maxLossAmount' => $order->max_loss_amount,
            'inputHandCount' => $order->input_hand_count,
            'inputPoint' => $order->input_point,
            'deposit' => $order->deposit,
            'lossPoint' => $order->loss_point,
            'lossAmount' => $order->loss_amount,
            'inputReason' => $order->input_reason,
            //图片未处理
            'inputImages' => $order->input_images,
            'outputHandCount' => $order->output_hand_count,
            'outputPoint' => $order->output_point,
            'outputAmount' => $order->output_amount,
            //平仓日志未处理
            'outputLog' => $order->output_log,
            'outputReason' => $order->output_reason,
            //图片未处理
            'outputImages' => $order->output_images,
            'total' => $order->total,
            'balance' => $order->balance,
            'frozen' => $order->frozen,
            'createdAt' => Carbon::parse($order->created_at)->toDateTimeString(),
        ];
    }

    /**
     * 创建订单
     *
     * @param OrderCreateVo $createVo
     * @return bool
     * @throws \Throwable
     */
    public function create(OrderCreateVo $createVo)
    {
        /** @var Account $account */
        $account = AccountDao::getById($createVo->getAccountId());
        $createVo->setAccountType($account->account_type);
        $createVo->setTotal($account->total);
        $createVo->setId(StringUtils::genGlobalUid());
        $createVo->setNo(OrderHelper::generateNumber($createVo->getOrderType()));
        //未处理-创建订单的上传入场图片
        DB::transaction('default', function () use ($createVo, $account) {
            //1.加仓单时，订单关联表要新增
            if ($createVo->getOrderType() == Order::ORDER_TYPE_ADD) {
                $createVo->checkOrderAddParameter();
                //关联订单的剩余可用止损金额 设置为加仓单的最大亏损金额
                /** @var Order $superOrder */
                $superOrder = $this->dao->getById($createVo->getOrderPid());
                $surplusLossAmount = floatBcsub($superOrder->max_loss_amount, $superOrder->loss_amount);
                $createVo->setMaxLossAmount($surplusLossAmount);
                OrderRelationDao::create($createVo->getOrderPid(), $superOrder->no, $createVo->getId(),
                    $createVo->getNo());
                //加仓单只冻结加仓单的总保证金，因为首单的冻结的最大亏损金额，包含了加仓单的止损金额，无需再次冻结
                list($balance, $frozen) = $this->getBalanceAndFrozen($account, 0,
                    $createVo->getDeposit());
            } else {
                $createVo->setMaxLossAmount(floatBcuml($account->balance, $account->ratio));
                //首单的可用余额、冻结资金
                list($balance, $frozen) = $this->getBalanceAndFrozen($account, $createVo->getMaxLossAmount(),
                    $createVo->getDeposit());
            }
            //系统计算的仓位 or 止损位置
            $systemFormula = $this->getOrderSystemFormula($createVo);
            (empty($createVo->getInputHandCount())) ? $createVo->setInputHandCount($systemFormula) : $createVo->setLossPoint($systemFormula);
            AccountDao::setAccountBalanceFrozen($account->getOriginal('id'), $balance, $frozen);
            $createVo->setBalance($balance);
            $createVo->setFrozen($frozen);
            $this->dao->create($createVo);
        });
        return true;
    }


    /**
     * 获取单子的仓位、止损位置
     *
     * @param $vo
     * @return int
     */
    private function getOrderSystemFormula($vo)
    {
        //新单子的仓位
        $arr = BeanUtil::transToMap($vo);
        /** @var OrderSystemFormulaVo $systemFormulaVo */
        $systemFormulaVo = BeanUtil::transToBean(OrderSystemFormulaVo::class, $arr);
        $systemFormula = OrderSystemFormulaService::getSystemFormula($systemFormulaVo);
        //手数仓位为空 判断系统仓位与下单仓位
        if (empty($arr['inputHandCount']) && $arr['inputHandCount'] > $systemFormula) {
            throw new BizException("下单仓位不可大于系统计算仓位！下单仓位：{$arr['inputHandCount']}，系统计算仓位：{$systemFormula}");
        }
        return $systemFormula;
    }

    /**
     * 根据最大亏损金额、总保证金，获取可用余额、冻结资金
     *
     * @param Account $account       账户信息
     * @param float   $maxLossAmount 最大亏损金额
     * @param float   $orderDeposit  总保证金
     * @return array
     */
    private function getBalanceAndFrozen(Account $account, float $maxLossAmount, float $orderDeposit)
    {
        $accountTotal = floatBcadd($account->balance, $account->frozen);
        //可用余额 = （账户可用余额-单笔最大亏损金额-总保证金）
        $balance = floatBcsub(floatBcsub($account->balance, $maxLossAmount), $orderDeposit);
        //冻结资金 = （账户冻结资金+单笔最大亏损金额+总保证金）
        $frozen = floatBcadd(floatBcadd($account->frozen, $maxLossAmount), $orderDeposit);
        $total = floatBcadd($balance, $frozen);
        if ($account->total != $accountTotal || $account->total != $total) {
            throw new BizException('总金额 != (可用余额+冻结资金)。请核实账户资金！');
        }
        return [$balance, $frozen];
    }


}