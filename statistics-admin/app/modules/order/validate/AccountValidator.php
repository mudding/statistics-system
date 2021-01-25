<?php
/**
 * Created by PhpStorm.
 * User: yuanfu
 * Date: 2021/1/11
 * Time: 12:12
 */

namespace app\modules\order\validate;

use framework\validate\Validate;

/**
 * Class LoginValidator
 */
class AccountValidator extends Validate
{
    //    private $name;
    //    private $phone;
    //    private $password;
    //规则
    protected $rule = [
        'name' => 'require',
        'phone' => 'require',
        'password' => 'require',
    ];

    //信息
    protected $message = [
        'name.present' => '请输入昵称',
        'phone.present' => '请输入手机号码',
        'password.present' => '请输入密码',
    ];

    //建议方法名称对应
    protected $scene = [
        'create' => [
            'name',
            'phone',
            'password',
        ],
    ];
}
