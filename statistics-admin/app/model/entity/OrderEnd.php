<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class OrderEnd
 *
 * @package app\model\entity
 * @property string|NULL    $id
 * @property string|NULL    $order_id                      订单id
 * @property string|NULL    $account_type                  账户类型
 * @property string|NULL    $order_no                      订单序号
 * @property string|NULL    $account_id                    关联的账户Id
 * @property string|NULL    $variety_id                    交易品种Id
 * @property string|NULL    $input_signal_time_id          入场信号周期id
 * @property string|NULL    $max_loss_amount               最大亏损金额
 * @property string|NULL    $hand_count                    总手数/仓位
 * @property string|NULL    $result_amount                 最终平仓所得金额
 * @property string|NULL    $user_name                     操作人
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OrderEnd extends Model
{
    /* --- 结果  --- */
    /** @var int 成功 */
    public const RESULT_SUCCESS = 1;
    /** @var int 失败 */
    public const RESULT_FAIL = 2;

    protected $primaryKey = 'id';

    protected $table = 'order_end';

    protected $fillable = [
        'id',
        'order_id',
        'account_type',
        'order_no',
        'account_id',
        'variety_id',
        'input_signal_time_id',
        'max_loss_amount',
        'hand_count',
        'result_amount',
        'user_name',
        'created_at',
        'updated_at'
    ];
}