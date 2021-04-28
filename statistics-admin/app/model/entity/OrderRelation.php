<?php

namespace app\model\entity;

use framework\db\Model;

/**
 * Class OrderRelation
 *
 * @package app\model\entity
 * @property string|NULL $id
 * @property string|NULL $order_id                      发起单/节点单id
 * @property string|NULL $order_no                      订单号
 * @property string|NULL $order_add_id                  加仓单id
 * @property string|NULL $order_add_no                  加仓单号
 */
class OrderRelation extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'order_relation';

    protected $fillable = [
        'id',
        'order_id',
        'order_no',
        'order_add_id',
        'order_add_no'
    ];
}