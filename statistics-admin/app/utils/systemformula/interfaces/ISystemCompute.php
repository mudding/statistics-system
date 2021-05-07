<?php

namespace app\utils\systemformula\interfaces;

use app\modules\order\vo\OrderSystemFormulaVo;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
interface ISystemCompute
{
    public static function compute(OrderSystemFormulaVo $systemFormulaVo);
}