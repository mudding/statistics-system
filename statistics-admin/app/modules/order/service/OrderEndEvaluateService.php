<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\service;

use app\modules\order\dao\OrderEndEvaluateDao;
use framework\util\Loader;

class OrderEndEvaluateService
{
    /** @var OrderEndEvaluateDao $dao */
    private $dao;

    /**
     * OrderEndEvaluateService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(OrderEndEvaluateDao::class);
    }
}