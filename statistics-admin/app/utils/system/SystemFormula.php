<?php
namespace app\utils\system;

use app\model\entity\Account;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\system\impl\FundImpl;
use app\utils\system\impl\FuturesImpl;
use app\utils\system\impl\Mt4Impl;
use app\utils\system\impl\OptionImpl;
use app\utils\system\impl\SharesImpl;
use app\utils\system\impl\UsHkStocksImpl;
use app\utils\system\impl\VirtualCurrencyImpl;
use app\utils\system\interfaces\ISystemFormula;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/29
 */
class SystemFormula implements ISystemFormula
{

    public static function start($accountType, OrderSystemFormulaVo $systemFormulaVo)
    {
        // TODO: Implement start() method.
        switch ($accountType) {
            case Account::ACCOUNT_TYPE_MT4 :
                $value = Mt4Impl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_FUTURES :
                $value = FuturesImpl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_OPTION :
                $value = OptionImpl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_SHARES :
                $value = SharesImpl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_FUND :
                $value = FundImpl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_US_HK_STOCKS :
                $value = UsHkStocksImpl::compute($systemFormulaVo);
                break;
            case Account::ACCOUNT_TYPE_VIRTUAL_CURRENCY :
                $value = VirtualCurrencyImpl::compute($systemFormulaVo);
                break;
            default:
                $value = 0;
                break;
        }
        return $value;
    }
}