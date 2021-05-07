<?php

namespace app\utils\systemformula\impl;

use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\interfaces\ISystemCompute;

/**
 * 美股港股
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
class UsHkStocksImpl implements ISystemCompute
{
    public static function compute(OrderSystemFormulaVo $systemFormulaVo)
    {
        return 0;
    }
}