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
use app\modules\order\dao\AccountDao;
use app\modules\order\dao\OrderDao;
use app\modules\order\dao\OrderRelationDao;
use app\modules\order\vo\OrderCreateVo;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\bean\BeanUtil;
use app\utils\order\OrderHelper;
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

    public function getById($accountId, $orderId)
    {
        /** @var Account $account */
        $account = AccountDao::getById($accountId);
        $data['account'] = [
            'accountType' => $account->account_type,
            'accountTypeName' => Account::ACCOUNT_TYPE[$account->account_type],
            'accountName' => $account->account_name,
            'accountNo' => $account->account_no,
            'total' => $account->total,
            'balance' => $account->balance,
            'frozen' => $account->frozen,
            'ratio' => floatval($account->ratio),
            'rati' => floatBcuml($account->ratio, 100) . '%',
        ];
        return $data;
    }


    public function create(OrderCreateVo $createVo)
    {
        /** @var Account $account */
        $account = AccountDao::getById($createVo->getAccountId());
        $createVo->setAccountType($account->account_type);
        $createVo->setTotal($account->total);
        $createVo->setMaxLossAmount(floatBcuml($account->balance, $account->ratio));
        $createVo->setId(StringUtils::genGlobalUid());
        $createVo->setNo(OrderHelper::generateNumber($createVo->getOrderType()));
        DB::transaction('default', function () use ($createVo, $account) {
            //1.加仓单时，订单关联表要新增
            if ($createVo->getOrderType() == Order::ORDER_TYPE_ADD) {
                $this->addSubOrder($createVo);
            } else {
                //新单子的仓位、止损位置
                $systemFormula = $this->getSuperOrderSystemFormula($createVo);
                (empty($createVo->getInputHandCount())) ? $createVo->setInputHandCount($systemFormula) : $createVo->setLossPoint($systemFormula);
            }
            //3.处理账户的资金,赋值总余额、可用余额、冻结余额
            list($balance, $frozen) = $this->getBalanceAndFrozen($account, $createVo->getMaxLossAmount(),
                $createVo->getDeposit());
            AccountDao::setAccountTotal($account->getOriginal('id'), $balance, $frozen);
            $createVo->setBalance($balance);
            $createVo->setFrozen($frozen);
            //新增订单
            $this->dao->create($createVo);
        });
        return true;
    }

    private function getSuperOrderSystemFormula($vo)
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


    private function getBalanceAndFrozen(Account $account, $maxLossAmount, $orderDeposit)
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


    private function addSubOrder(OrderCreateVo $createVo)
    {
        //查询账户，赋值余额

        //查询加仓的订单，获取最大止损金额，判断止损金额参数，风控
        //风控，计算加仓的仓位、亏损资金，是否在主订单最大亏损金额内，设置止损金额/最大止损金额/余额
//关联订单id/no,不能为空
        $createVo->checkOrderAddParameter();
        //新增关联数据
        OrderRelationDao::create($createVo->getOrderPid(),
            $createVo->getOrderPno(),
            $createVo->getId(),
            $createVo->getNo());
    }


}