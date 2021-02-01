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
    /** @var OrderLogDao $dao */
    private $dao;

    /**
     * OrderLogService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(OrderLogDao::class);
    }

}