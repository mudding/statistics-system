<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use framework\db\Model;

class SignalTime extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'signal_time';

    protected $fillable = [
        'id',
        'signal_time_name',
        'created_at',
        'updated_at'
    ];
}