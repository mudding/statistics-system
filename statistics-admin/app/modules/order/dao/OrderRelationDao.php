<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\dao;

use app\model\entity\OrderRelation;
use framework\string\StringUtils;

class OrderRelationDao
{
    /**
     * @param $orderPid
     * @param $orderPno
     * @param $orderAddId
     * @param $orderAddNo
     * @return bool
     */
    public static function create($orderPid, $orderPno, $orderAddId, $orderAddNo)
    {
        return OrderRelation::query()->insert([
            'id' => StringUtils::genGlobalUid(),
            'order_id' => $orderPid,
            'order_no' => $orderPno,
            'order_add_id' => $orderAddId,
            'order_add_no' => $orderAddNo
        ]);
    }
}