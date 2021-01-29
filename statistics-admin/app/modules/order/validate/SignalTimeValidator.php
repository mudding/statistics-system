<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\validate;

use framework\validate\Validate;

class SignalTimeValidator extends Validate
{
    protected $rule = [
        'id' => 'require',
        'name' => 'require',
    ];

    //信息
    protected $message = [
        'id.present' => '请输入id',
        'name.present' => '请输入信号周期',
    ];

    //建议方法名称对应
    protected $scene = [
        'create' => ['name'],
        'update' => ['id', 'name'],
        'delete' => ['id'],
    ];
}