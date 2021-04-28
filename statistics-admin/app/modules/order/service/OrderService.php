<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\OrderDao;
use app\modules\order\vo\OrderCreateVo;
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

    }
}