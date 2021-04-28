<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class SignalTime
 *
 * @package app\model\entity
 * @property string|null $id
 * @property string|null $signal_time_name 周期名称
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
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