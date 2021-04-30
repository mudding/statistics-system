<?php

namespace app\utils\system\interfaces;

use app\modules\order\vo\OrderSystemFormulaVo;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/29
 */
interface ISystemFormula
{
    public static function start($accountType, OrderSystemFormulaVo $systemFormulaVo);
}