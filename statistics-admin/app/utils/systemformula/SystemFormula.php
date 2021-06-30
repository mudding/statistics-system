<?php
namespace app\utils\systemformula;

use app\model\entity\Account;
use app\modules\order\vo\OrderSystemFormulaVo;
use app\utils\systemformula\impl\ForeignExchangeImpl;
use app\utils\systemformula\impl\FundImpl;
use app\utils\systemformula\impl\FuturesImpl;
use app\utils\systemformula\impl\OptionImpl;
use app\utils\systemformula\impl\SharesImpl;
use app\utils\systemformula\impl\UsHkStocksImpl;
use app\utils\systemformula\impl\VirtualCurrencyImpl;
use app\utils\systemformula\interfaces\ISystemFormula;

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
            //外汇
            case Account::ACCOUNT_TYPE_FOREIGN_EXCHANGE :
                $value = ForeignExchangeImpl::compute($systemFormulaVo);
                break;
            //期货
            case Account::ACCOUNT_TYPE_FUTURES :
                $value = FuturesImpl::compute($systemFormulaVo);
                break;
            //期权
            case Account::ACCOUNT_TYPE_OPTION :
                $value = OptionImpl::compute($systemFormulaVo);
                break;
            //股票
            case Account::ACCOUNT_TYPE_SHARES :
                $value = SharesImpl::compute($systemFormulaVo);
                break;
            //基金
            case Account::ACCOUNT_TYPE_FUND :
                $value = FundImpl::compute($systemFormulaVo);
                break;
            //美股港股
            case Account::ACCOUNT_TYPE_US_HK_STOCKS :
                $value = UsHkStocksImpl::compute($systemFormulaVo);
                break;
            //虚拟币
            case Account::ACCOUNT_TYPE_VIRTUAL_CURRENCY :
                $value = VirtualCurrencyImpl::compute($systemFormulaVo);
                break;
            default:
                $value = 0;
                break;
        }
        return abs($value);
    }
}