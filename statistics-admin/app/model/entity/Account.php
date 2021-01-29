<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use framework\db\Model;

class Account extends Model
{
    /* --- 账户类型  --- */
    /** @var int 外汇 */
    public const ACCOUNT_TYPE_MT4 = 1;
    /** @var int 期货 */
    public const ACCOUNT_TYPE_FUTURES = 2;
    /** @var int 股票 */
    public const ACCOUNT_TYPE_SHARES = 3;
    /** @var int 基金 */
    public const ACCOUNT_TYPE_FUND = 4;

    /* --- 账户状态  --- */
    /** @var int 持单中 */
    public const ACCOUNT_STATUS_ING = 1;
    /** @var int 空仓 */
    public const ACCOUNT_STATUS_NULL = 2;

    protected $primaryKey = 'id';

    protected $table = 'account';

    protected $fillable = [
        'id',
        'user_id',
        'account_type',
        'account_name',
        'account_no',
        'account_status',
        'total',
        'balance',
        'frozen',
        'user_name',
        'created_at',
        'updated_at'
    ];

}