<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\OrderEndDao;
use framework\util\Loader;

class OrderEndService
{
    /** @var OrderEndDao $dao  */
    private $dao;

    /**
     * OrderEndService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(OrderEndDao::class);
    }
}