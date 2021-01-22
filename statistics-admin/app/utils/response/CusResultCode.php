<?php
namespace app\utils\response;

use framework\util\ResultCode;

class CusResultCode extends ResultCode
{
    //认证
    public const AUTHENTICATION_ERROR = ['code' => '002', 'message' => '请先登录!'];
}
