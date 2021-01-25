<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\VarietyDao;
use framework\util\Loader;

class VarietyService
{
    /** @var VarietyDao $varietyDao  */
    private $varietyDao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->varietyDao = Loader::singleton(VarietyDao::class);
    }

}