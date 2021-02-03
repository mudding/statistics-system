<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\validate;

use framework\validate\Validate;

class OrderLogValidate extends Validate
{
    protected $rule = [
        'id' => 'require',
        'accountType' => 'require',
        'no' => 'require',
        'orderType' => 'require',
        'orderStatus' => 'require',
        'accountId' => 'require',
        'varietyId' => 'require',
        'maxLossAmount' => 'require',
        'inputSignalTimeId' => 'require',
        'inputHandCount' => 'require',
        'inputPoint' => 'require',
        'deposit' => 'require',
        'lossAmount' => 'require',
        'inputReason' => 'require',
        'inputImages' => 'require',
        'outputHandCount' => 'require',
        'outputPoint' => 'require',
        'outputAmount' => 'require',
        'outputReason' => 'require',
        'outputImages' => 'require',
    ];

    //信息
    protected $message = [
        'id.present' => '请输入id',
        'accountType.present' => '请选择账户类型',
        'no.present' => '请输入订单号',
        'orderType.present' => '请选择订单类型',
        'orderStatus.present' => '请选择订单状态',
        'accountId.present' => '请输入账户Id',
        'varietyId.present' => '请输入交易品种Id',
        'maxLossAmount.present' => '请输入最大亏损金额',
        'inputSignalTimeId.present' => '请选择入场信号周期id',
        'inputHandCount.present' => '请输入手数/仓位',
        'inputPoint.present' => '请输入入场点数',
        'deposit.present' => '请输入保证金',
        'lossAmount.present' => '请输入该仓位止损金额',
        'inputReason.present' => '请输入入场理由',
        'inputImages.present' => '请上传入场图片',
        'outputHandCount.present' => '请输入平仓手数',
        'outputPoint.present' => '请输入出场点',
        'outputAmount.present' => '请输入平仓所得金额',
        'outputReason.present' => '请输入出场理由',
        'outputImages.present' => '请上传出场图片'
    ];

    //建议方法名称对应
    protected $scene = [
        'getList' => ['accountType'],
        'create' => ['accountType', 'varietyName'],
        'update' => ['id', 'accountType', 'varietyName'],
        'delete' => ['id'],
    ];
}