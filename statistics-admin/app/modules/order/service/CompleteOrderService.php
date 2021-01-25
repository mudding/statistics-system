<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\CompleteOrderDao;
use framework\util\Loader;

class CompleteOrderService
{
    /** @var CompleteOrderDao $completeOrderDao  */
    private $completeOrderDao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->completeOrderDao = Loader::singleton(CompleteOrderDao::class);
    }
}