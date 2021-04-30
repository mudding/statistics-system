<?php

namespace app\utils\system\impl;

use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\system\interfaces\ISystemCompute;

/**
 * 外汇
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
class Mt4Impl implements ISystemCompute
{
    public static function compute(OrderSystemFormulaVo $systemFormulaVo)
    {
        return 0;

    }
}