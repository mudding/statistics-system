<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\dao;

use app\model\entity\Account;
use app\model\entity\Order;
use app\modules\order\vo\OrderCreateVo;

class OrderDao
{

    /**
     * @param OrderCreateVo $createVo
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(OrderCreateVo $createVo)
    {
        //创建订单，订单状态只能是持单中、计划中
        return Order::query()->create([
            'id' => $createVo->getId(),
            'no' => $createVo->getNo(),
            'account_id' => $createVo->getAccountId(),
            'account_type' => $createVo->getAccountType(),
            'order_type' => $createVo->getOrderType(),
            'order_status' => empty($createVo->getIsPlan()) ? Order::ORDER_STATUS_ING : Order::ORDER_STATUS_PLAN_ING,
            'variety_id' => $createVo->getVarietyId(),
            'input_signal_time_id' => $createVo->getInputSignalTimeId(),
            'input_hand_count' => $createVo->getInputHandCount(),
            'input_point' => $createVo->getInputPoint(),
            'deposit' => $createVo->getDeposit(),
            'loss_point' => $createVo->getLossPoint(),
            'loss_amount' => $createVo->getLossAmount(),
            'input_reason' => $createVo->getInputReason(),
            'input_images' => $createVo->getInputImages(),
            'max_loss_amount' => $createVo->getMaxLossAmount(),
            'total' => $createVo->getTotal(),
            'balance' => $createVo->getBalance(),
            'frozen' => $createVo->getFrozen(),
            'direction' => $createVo->getDirection()
        ]);
    }

    /**
     * @param $accountId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function searchOrderByAccountId($accountId)
    {
        return Order::query()->where('account_id', $accountId)
            ->whereIn('order_status', [Order::ORDER_STATUS_ING, Order::ORDER_STATUS_CLOSE_SOME])
            ->paginate();
    }

    /**
     * @param $orderId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getById($orderId)
    {
        return Order::query()->where('id', $orderId)->first();
    }
}