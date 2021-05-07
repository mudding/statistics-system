<?php

namespace app\utils\systemformula\impl;

use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\interfaces\ISystemCompute;

/**
 * 外汇（止损金额=下单手数*止损点数*10）
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
class ForeignExchangeImpl implements ISystemCompute
{
    /**
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return float
     */
    public static function compute(OrderSystemFormulaVo $systemFormulaVo)
    {
        if (empty($systemFormulaVo->getInputHandCount())) {
            return self::calculateInputHandCount($systemFormulaVo);
        }
        return self::calculateLossPoint($systemFormulaVo);
    }

    /**
     * 根据止损金额&止损位置计算出的手数，求->下单手数 = 止损金额/(止损点数*倍数*10)
     *
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return float
     */
    private static function calculateInputHandCount(OrderSystemFormulaVo $systemFormulaVo)
    {
        //止损点数 = 入场位置-止损位置
        $stopLossMargin = floatBcsub($systemFormulaVo->getInputPoint(), $systemFormulaVo->getLossPoint());
        // 止损区间差数 = (止损点数*倍数*10)；
        $stopLossRange = floatBcuml(floatBcuml($stopLossMargin, $systemFormulaVo->getOtherMultiple()), 10);
        //下单手数 = 止损金额/(止损点数*倍数*10)
        return floatBcdiv($systemFormulaVo->getLossAmount(), $stopLossRange);
    }

    /**
     * 求->止损位置 = 入场位置+ (止损金额/下单手数)/(倍数*10)
     *
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return float
     */
    private static function calculateLossPoint(OrderSystemFormulaVo $systemFormulaVo)
    {
        // 除数倍数 = 额外的倍数*10
        $multiple = floatBcuml($systemFormulaVo->getOtherMultiple(), 10);
        // 止损区间差数 = (止损金额/下单手数)/(倍数*10)
        $stopLossRange = floatBcdiv(floatBcdiv($systemFormulaVo->getLossAmount(),
            $systemFormulaVo->getInputHandCount()), $multiple);
        // 止损位置 = 入场位置+止损区间差数
        return floatBcadd($systemFormulaVo->getInputPoint(), $stopLossRange);
    }

}