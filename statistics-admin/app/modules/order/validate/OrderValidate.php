<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\validate;

use framework\validate\Validate;

class OrderValidate extends Validate
{
    protected $rule = [
        'id' => 'require',
        'accountId' => 'require',
        'orderType' => 'require',
        'isPlan' => 'require｜in:0,1',
        'varietyId' => 'require',
        'inputSignalTimeId' => 'require',
        'inputHandCount' => 'require',
        'inputPoint' => 'require',
        'deposit' => 'require',
        'lossPoint' => 'require',
        'lossAmount' => 'require',
        'inputReason' => 'require',
        'outputHandCount' => 'require',
        'outputPoint' => 'require',
        'outputAmount' => 'require',
        'outputReason' => 'require',
    ];

    //信息
    protected $message = [
        'id.present' => 'id不能为空',
        'accountId.present' => '请输入账户Id',
        'orderType.present' => '请选择订单类型',
        'isPlan.present' => '请选择是否计划单',
        'varietyId.present' => '请输入交易品种Id',
        'inputSignalTimeId.present' => '请选择入场信号周期id',
        'inputHandCount.present' => '请输入手数/仓位',
        'inputPoint.present' => '请输入入场点数',
        'deposit.present' => '请输入保证金',
        'lossPoint.present' => '请输入止损点位',
        'lossAmount.present' => '请输入该仓位止损金额',
        'inputReason.present' => '请输入入场理由',
        'inputImages.present' => '请上传入场图片',
        'outputHandCount.present' => '请输入平仓手数',
        'outputPoint.present' => '请输入出场点',
        'outputAmount.present' => '请输入平仓所得金额',
        'outputReason.present' => '请输入出场理由',
    ];

    //建议方法名称对应
    protected $scene = [
        'create' => [
            'accountId',
            'orderType',
            'varietyId',
            'inputSignalTimeId',
            'inputHandCount',
            'inputPoint',
            'deposit',
            'lossAmount',
            'lossPoint',
            'inputReason'
        ],
        'update' => [
            'id',
            'accountId',
            'orderType',
            'orderStatus',
            'varietyId',
            'inputSignalTimeId',
            'inputHandCount',
            'inputPoint',
            'deposit',
            'lossAmount',
            'lossPoint',
            'inputReason',
            'outputHandCount',
            'outputPoint',
            'outputAmount',
            'outputReason'
        ],
        'getSystemFormula' => ['accountId', 'inputPoint'],
    ];
}