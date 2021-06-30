<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\model\entity\Order;
use app\modules\order\service\OrderService;
use app\modules\order\service\OrderSystemFormulaService;
use app\modules\order\vo\OrderCreateVo;
use app\modules\order\vo\OrderSystemFormulaVo;
use framework\Controller;
use framework\request\RequestInterface;
use framework\util\Loader;
use framework\util\Result;

class OrderAction extends Controller
{
    /** @var OrderService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderService::class);
    }

    /**
     * 总数据 = 账户信息+首单+加仓单
     *
     * @param RequestInterface $request
     * @return Result
     */
    public function details(RequestInterface $request)
    {
        $accountId = $request->getParameter('accountId');
        $orderId = $request->getParameter('orderId');
        $data = $this->service->details($accountId, $orderId);
        $extra['orderType'] = Order::ORDER_TYPE;
        $extra['orderDirection'] = Order::ORDER_DIRECTION;
        $extra['orderStatus'] = Order::ORDER_STATUS;
        return Result::ok()->data($data)->extra($extra);
    }

    /**
     * 单条订单数据 = 账户信息+单条数据
     *
     * @param RequestInterface $request
     * @return Result
     */
    public function getById(RequestInterface $request)
    {
        $accountId = $request->getParameter('accountId');
        $orderId = $request->getParameter('orderId');
        $data = $this->service->getById($accountId, $orderId);
        $extra['orderType'] = Order::ORDER_TYPE;
        $extra['orderDirection'] = Order::ORDER_DIRECTION;
        $extra['orderStatus'] = Order::ORDER_STATUS;
        return Result::ok()->data($data)->extra($extra);
    }

    /**
     * @param OrderCreateVo $orderLogVo
     * @return Result
     * @throws \Throwable
     */
    public function create(OrderCreateVo $orderLogVo)
    {
        $res = $this->service->create($orderLogVo);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return Result
     */
    public function getSystemFormula(OrderSystemFormulaVo $systemFormulaVo)
    {
        $systemFormulaVo->checkNotEmpty();
        $data = OrderSystemFormulaService::getSystemFormula($systemFormulaVo);
        return Result::ok()->data($data);
    }

}