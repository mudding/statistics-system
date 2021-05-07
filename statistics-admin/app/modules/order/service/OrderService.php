<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\model\entity\Account;
use app\model\entity\Order;
use app\modules\order\dao\AccountDao;
use app\modules\order\dao\OrderDao;
use app\modules\order\vo\OrderCreateVo;
use app\utils\order\OrderHelper;
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

    public function create(OrderCreateVo $createVo)
    {
        /** @var Account $account */
        $account = AccountDao::getById($createVo->getAccountId());
        $createVo->setAccountType($account->account_type);
        $orderId = StringUtils::genGlobalUid();
        $createVo->setOrderId($orderId);
        $orderNo = OrderHelper::generateNumber($createVo->getOrderType());
        $createVo->setOrderNo($orderNo);
        //加仓单时，关联表要新增
        if ($createVo->getOrderType() == Order::ORDER_TYPE_ADD) {
            $createVo->checkOrderAdd();
        }
        //账户状态要更新
        $account->
        $this->dao->create($createVo);
    }

}