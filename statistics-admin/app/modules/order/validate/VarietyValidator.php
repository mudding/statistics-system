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
 * Class VarietyValidator
 *
 * @package app\modules\order\validate
 */
class VarietyValidator extends Validate
{
    protected $rule = [
        'id' => 'require',
        'accountType' => 'require',
        'varietyName' => 'require',
    ];

    //信息
    protected $message = [
        'id.present' => '请输入id',
        'accountType.present' => '请选择账户类型',
        'varietyName.present' => '请输入交易品种名称',
    ];

    //建议方法名称对应
    protected $scene = [
        'create' => ['accountType', 'varietyName'],
        'update' => ['id', 'accountType', 'varietyName'],
        'delete' => ['id'],
    ];
}
