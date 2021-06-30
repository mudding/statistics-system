<?php

/**
 * 订单系统公式计算
 *
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\service;

use app\model\entity\Account;
use app\modules\order\dao\AccountDao;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\SystemFormula;

class OrderSystemFormulaService
{
    /**
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return int
     */
    public static function getSystemFormula(OrderSystemFormulaVo $systemFormulaVo)
    {
        /** @var Account $data */
        $data = AccountDao::getById($systemFormulaVo->getAccountId());
        $maxLossAmount = floatBcuml($data->balance, $data->ratio);
        $systemFormulaVo->setMaxLossAmount($maxLossAmount);
        $systemFormulaVo->checkLossAmount();
        $systemFormulaVo->setBalance($data->balance);
        return SystemFormula::start($data->account_type, $systemFormulaVo);
    }

}