<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\model\entity;

use framework\db\Model;

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