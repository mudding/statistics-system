<?php
/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;


use framework\db\Model;

class OrderLog extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'order_log';

    protected $fillable = [
        'id',
        'account_type',
        'no',
        'order_type',
        'account_status',
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
        'user_name',
        'created_at',
        'updated_at'
    ];
}