<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\service;

use app\modules\order\dao\OrderRelationDao;
use framework\util\Loader;

class OrderRelationService
{
    /** @var OrderRelationDao $dao */
    private $dao;

    /**
     * OrderRelationService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(OrderRelationDao::class);
    }
}