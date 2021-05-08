<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class Account
 *
 * @package app\model\entity
 * @property string|NULL $id
 * @property string|NULL $user_id       关联的用户id
 * @property string|NULL $account_type  账户类型,1=外汇,2=期货,3=期权,4=股票,5=基金,6=美股港股,7=虚拟币
 * @property string|NULL $account_name  账户名称
 * @property string|NULL $account_no    账户号码
 * @property string|NULL $total         总金额(浮动)
 * @property string|NULL $balance       可用余额(浮动)
 * @property string|NULL $frozen        冻结金额-持单的最大亏损金额汇总(浮动)
 * @property string|NULL $user_name     操作人
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @property string|NULL $ratio         做单系数
 * @property Account     $account
 */
class Account extends Model
{
    /* --- 账户类型  --- */
    /** @var int 外汇 */
    const ACCOUNT_TYPE_FOREIGN_EXCHANGE = 1;
    /** @var int 期货 */
    const ACCOUNT_TYPE_FUTURES = 2;
    /** @var int 期权 */
    const ACCOUNT_TYPE_OPTION = 3;
    /** @var int 股票 */
    const ACCOUNT_TYPE_SHARES = 4;
    /** @var int 基金 */
    const ACCOUNT_TYPE_FUND = 5;
    /** @var int 美股港股 */
    const ACCOUNT_TYPE_US_HK_STOCKS = 6;
    /** @var int 虚拟币 */
    const ACCOUNT_TYPE_VIRTUAL_CURRENCY = 7;
    const ACCOUNT_TYPE = [
        self::ACCOUNT_TYPE_FOREIGN_EXCHANGE => '外汇',
        self::ACCOUNT_TYPE_FUTURES => '期货',
        self::ACCOUNT_TYPE_OPTION => '期权',
        self::ACCOUNT_TYPE_SHARES => '股票',
        self::ACCOUNT_TYPE_FUND => '基金',
        self::ACCOUNT_TYPE_US_HK_STOCKS => '美股港股',
        self::ACCOUNT_TYPE_VIRTUAL_CURRENCY => '虚拟币',
    ];

    /* --- 账户状态  --- */
    /** @var int 账户状态-持单中 */
    public const ACCOUNT_STATUS_ING = '持单中';
    /** @var int 账户状态-空仓 */
    public const ACCOUNT_STATUS_NULL = '空仓';


    protected $primaryKey = 'id';

    protected $table = 'account';

    /** @var string[] */
    protected $fillable = [
        'id',
        'user_id',
        'account_type',
        'account_name',
        'account_no',
        'total',
        'balance',
        'frozen',
        'user_name',
        'ratio',
        'created_at',
        'updated_at'
    ];

}