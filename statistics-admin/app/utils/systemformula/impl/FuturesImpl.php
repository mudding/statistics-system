<?php

namespace app\utils\systemformula\impl;

use app\exception\BizException;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\interfaces\ISystemCompute;

/**
 * 期货
 * （余额 >= (下单手数*保证金)+止损金额)
 *  止损金额 = 下单手数*止损点数*10
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/30
 */
class FuturesImpl implements ISystemCompute
{

    public static function compute(OrderSystemFormulaVo $systemFormulaVo)
    {
        $systemFormulaVo->checkDeposit();
        if (empty($systemFormulaVo->getInputHandCount())) {
            //检查下单手数是否合理，返回合理的仓位
            $inputHandCount = self::calculateInputHandCount($systemFormulaVo);
            return self::checkInputHandCount($systemFormulaVo->getBalance(), $inputHandCount,
                $systemFormulaVo->getDeposit(),
                $systemFormulaVo->getLossAmount());
        }
        $inputHandCount = self::checkInputHandCount($systemFormulaVo->getBalance(),
            $systemFormulaVo->getInputHandCount(),
            $systemFormulaVo->getDeposit(),
            $systemFormulaVo->getLossAmount());
        if ($inputHandCount != $systemFormulaVo->getInputHandCount()) {
            throw new BizException('该仓位 \'风险过大\'。强烈建议，请减少仓位！');
        }
        //止损位置
        return self::calculateLossPoint($systemFormulaVo);
    }


    /**
     * 根据止损金额&止损位置计算出的手数，求->下单手数 = 止损金额 /(止损点数*10)
     *
     *
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return float
     */
    private static function calculateInputHandCount(OrderSystemFormulaVo $systemFormulaVo)
    {
        //止损点数 = 入场位置-止损位置
        $stopLossMargin = abs(floatBcsub($systemFormulaVo->getInputPoint(), $systemFormulaVo->getLossPoint()));
        //止损区间差数 = (止损点数*10)；
        $stopLossRange = floatBcuml($stopLossMargin, 10);
        //向下取整，下单手数 = 止损金额/(止损点数*10)
        return floor(floatBcdiv($systemFormulaVo->getLossAmount(), $stopLossRange));
    }


    /**
     * 检查下单手数是否合理，返回合理的仓位
     *
     * @param $balance
     * @param $inputHandCount
     * @param $deposit
     * @param $lossAmount
     * @return mixed
     */
    private static function checkInputHandCount($balance, $inputHandCount, $deposit, $lossAmount)
    {
        //余额 > 本单总保证金+止损金额，才可以
        $funds = floatBcadd($deposit, $lossAmount);
        //余额小于'需要用金额'时，重新计算手数
        if ($balance < $funds) {
            unset($funds);
            $inputHandCount--;
            self::checkInputHandCount($balance, $inputHandCount, $deposit, $lossAmount);
        }
        return $inputHandCount;
    }

    /**
     * @param $deposit
     * @param $lossAmount
     * @return float (本单总保证金)+止损金额
     */
    public static function calculateFunds($deposit, $lossAmount)
    {
        //(下单手数*1手的保证金)+止损金额
//        return floatBcadd(floatBcuml($inputHandCount, $deposit), $lossAmount);
        return floatBcadd($deposit, $lossAmount);

    }


    /**
     * 求->止损位置 = 入场位置 + (止损金额/下单手数)/10
     *
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return float
     */
    private static function calculateLossPoint(OrderSystemFormulaVo $systemFormulaVo)
    {
        // 止损区间差数 = (止损金额/下单手数)/10
        $stopLossRange = floatBcdiv(floatBcdiv($systemFormulaVo->getLossAmount(),
            $systemFormulaVo->getInputHandCount()), 10);
        // 止损位置 = 入场位置+止损区间差数
        return floatBcadd($systemFormulaVo->getInputPoint(), $stopLossRange);
    }
}