<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\OrderLogDao;
use framework\util\Loader;

class OrderLogService
{
    /** @var OrderLogDao $orderLogDao */
    private $orderLogDao;

    /**
     * OrderLogService constructor.
     */
    public function __construct()
    {
        $this->orderLogDao = Loader::singleton(OrderLogDao::class);
    }

}