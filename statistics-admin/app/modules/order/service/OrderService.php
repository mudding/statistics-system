<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\model\entity\Account;
use app\model\entity\Order;
use app\model\entity\OrderRelation;
use app\modules\order\dao\AccountDao;
use app\modules\order\dao\OrderDao;
use app\modules\order\dao\OrderRelationDao;
use app\modules\order\vo\OrderCreateVo;
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

    public function create(OrderCreateVo $createVo)
    {
        /** @var Account $account */
        $account = AccountDao::getById($createVo->getAccountId());
        $createVo->setId(StringUtils::genGlobalUid());
        $createVo->setNo(OrderHelper::generateNumber($createVo->getOrderType()));
        $createVo->setMaxLossAmount(floatBcuml($account->balance, $account->ratio));
        DB::transaction('default', function () use ($createVo) {
            //加仓单时，关联表要新增
            if ($createVo->getOrderType() == Order::ORDER_TYPE_ADD) {
                $createVo->checkOrderAddParameter();
                OrderRelationDao::create($createVo->getOrderPid(),
                    $createVo->getOrderPno(),
                    $createVo->getId(),
                    $createVo->getNo());
            }
            //处理账户的资金
            $this->dao->create($createVo);
        });
        return true;
    }

}