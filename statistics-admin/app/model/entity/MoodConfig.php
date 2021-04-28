<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/28
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class MoodConfig
 *
 * @package app\model\entity
 * @property string|NULL $id
 * @property string|NULL $value
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class MoodConfig extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'mood_config';

    protected $fillable = [
        'id',
        'value',
        'created_at',
        'updated_at'
    ];

}