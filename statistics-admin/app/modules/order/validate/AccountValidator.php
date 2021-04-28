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
    //规则
    protected $rule = [
        'id' => 'require',
        'accountType' => 'require',
        'accountName' => 'require',
        'accountNo' => 'require',
        'total' => 'require',
        'ratio' => 'require|float',
    ];

    //信息
    protected $message = [
        'id.present' => '请输入id',
        'accountType.present' => '请选择账户类型',
        'accountName.present' => '请输入账户名称',
        'accountNo.present' => '请输入账户号码',
        'total.present' => '请输入总金额',
        'ratio.present' => '请输入系数',
    ];

    //建议方法名称对应
    protected $scene = [
        'create' => ['accountType', 'accountName', 'accountNo', 'total', 'ratio'],
        'update' => ['id', 'total', 'ratio'],
        'getList' => [],
    ];
}
