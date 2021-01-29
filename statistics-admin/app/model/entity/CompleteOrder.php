<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use framework\db\Model;

class CompleteOrder extends Model
{
    /* --- 结果  --- */
    /** @var int 成功 */
    public const RESULT_SUCCESS = 1;
    /** @var int 失败 */
    public const RESULT_FAIL = 2;

    protected $primaryKey = 'id';

    protected $table = 'complete_order';

    protected $fillable = [
        'id',
        'account_type',
        'order_no',
        'account_id',
        'variety_id',
        'input_signal_time_id',
        'max_loss_amount',
        'hand_count',
        'result_amount',
        'result',
        'summary',
        'user_name',
        'created_at',
        'updated_at'
    ];
}