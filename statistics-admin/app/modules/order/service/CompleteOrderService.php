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
    /** @var CompleteOrderDao $dao  */
    private $dao;

    /**
     * CompleteOrderService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(CompleteOrderDao::class);
    }
}