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
 * @property string|NULL $account_type  账户类型,1=外汇,2=期货,3=股票,4=基金
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
    public const ACCOUNT_TYPE_MT4 = 1;
    /** @var int 期货 */
    public const ACCOUNT_TYPE_FUTURES = 2;
    /** @var int 期权 */
    public const ACCOUNT_TYPE_OPTION = 3;
    /** @var int 股票 */
    public const ACCOUNT_TYPE_SHARES = 4;
    /** @var int 基金 */
    public const ACCOUNT_TYPE_FUND = 5;
    /** @var int 美股港股 */
    public const ACCOUNT_TYPE_US_HK_STOCKS = 6;
    /** @var int 虚拟币 */
    public const ACCOUNT_TYPE_VIRTUAL_CURRENCY = 7;

    /* --- 账户状态  --- */
    /** @var int 持单中 */
    public const ACCOUNT_STATUS_ING = 1;
    /** @var int 空仓 */
    public const ACCOUNT_STATUS_NULL = 2;

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