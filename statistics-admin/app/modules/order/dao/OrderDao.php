<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\dao;

use app\model\entity\Order;
use app\modules\order\vo\OrderCreateVo;

class OrderDao
{

    public function create(OrderCreateVo $createVo)
    {
        return Order::query()->create([
            'id' => $createVo->getOrderId(),
            'no' => $createVo->getOrderNo(),
            'account_id' => $createVo->getAccountId(),
            'account_type' => $createVo->getAccountType(),
            'order_type',
            'order_status',
            'variety_id',
            'max_loss_amount',
            'input_signal_time_id',
            'input_hand_count',
            'input_point',
            'deposit',
            'loss_point',
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
        ]);
    }
}