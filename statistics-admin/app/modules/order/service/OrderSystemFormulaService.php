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
use app\utils\system\SystemFormula;
use framework\util\Loader;

class OrderSystemFormulaService
{
    /**
     * @param OrderSystemFormulaVo $systemFormulaVo
     * @return int
     */
    public function getSystemFormula(OrderSystemFormulaVo $systemFormulaVo)
    {
        /** @var AccountDao $dao */
        $dao = Loader::singleton(AccountDao::class);
        /** @var Account $data */
        $data = $dao->getById($systemFormulaVo->getAccountId());
        return SystemFormula::start($data->account_type, $systemFormulaVo);
    }

}