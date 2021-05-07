<?php

namespace app\utils\systemformula\impl;

use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\interfaces\ISystemCompute;

/**
 * 基金
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
class FundImpl implements ISystemCompute
{
    public static function compute(OrderSystemFormulaVo $systemFormulaVo)
    {
        return 0;
    }
}