<?php
/**
 * Created by PhpStorm.
 * User: yuanfu
 * Date: 2021/1/11
 * Time: 12:12
 */

namespace app\modules\admin\validate;

use framework\validate\Validate;

/**
 * Class LoginValidator
 */
class LoginValidator extends Validate
{
    //规则
    protected $rule = [
        'phone' => 'require',
        'password' => 'require',
    ];

    //信息
    protected $message = [
        'phone.present' => '请输入手机号码',
        'password.present' => '请输入密码',
    ];

    //建议方法名称对应
    protected $scene = [
        'login' => [
            'phone',
            'password',
        ],
    ];
}
