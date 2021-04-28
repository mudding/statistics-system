<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class Variety
 *
 * @package app\model\entity
 * @property string|null $id
 * @property string|null $account_type 账户类型
 * @property string|null $variety_name 品种名称
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 */
class Variety extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'variety';

    protected $fillable = [
        'id',
        'account_type',
        'variety_name',
        'created_at',
        'updated_at'
    ];
}