<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use framework\db\Model;

class Account extends Model
{
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
        'occupancy_rate',
        'profit',
        'loss',
        'user_name',
        'created_at',
        'updated_at'
    ];

}