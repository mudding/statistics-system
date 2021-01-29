<?php
/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;


use framework\db\Model;

class OrderLog extends Model
{
    /* --- 订单类型  --- */
    /** @var int 初始单 */
    public const ORDER_TYPE_START = 1;
    /** @var int 加仓单 */
    public const ORDER_TYPE_ADD = 2;

    /* --- 账户状态  --- */
    /** @var int 持单中 */
    public const ORDER_STATUS_ING = 1;
    /** @var int 平一些 */
    public const ORDER_STATUS_CLOSE_SOME = 2;
    /** @var int 全平 */
    public const ORDER_STATUS_CLOSE_ALL = 3;
    /** @var int 计划中 */
    public const ORDER_STATUS_PLAN_ING = 4;
    /** @var int 计划失败 */
    public const ORDER_STATUS_PLAN_FAIL = 5;

    protected $primaryKey = 'id';

    protected $table = 'order_log';

    protected $fillable = [
        'id',
        'account_type',
        'no',
        'order_type',
        'order_status',
        'account_id',
        'variety_id',
        'max_loss_amount',
        'input_signal_time_id',
        'input_hand_count',
        'input_point',
        'deposit',
        'loss_amount',
        'input_reason',
        'input_images',
        'output_hand_count',
        'output_point',
        'output_amount',
        'output_log',
        'output_reason',
        'output_images',
        'total',
        'balance',
        'frozen',
        'user_name',
        'created_at',
        'updated_at'
    ];
}