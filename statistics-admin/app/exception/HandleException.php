<?php

namespace app\exception;

use app\utils\response\CusResultCode;
use framework\exception\BaseExceptionHandler;

use framework\exception\ValidateException;
use framework\log\Log;
use framework\util\Result;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

/**
 * Class HandlerException
 * @package app\exception
 */
class HandleException extends BaseExceptionHandler
{
    protected $ignores = [
    ];

    /**
     * @param Throwable $e
     * 异常托管到这个方法
     */
    public function handleException(Throwable $e): void
    {
        if (! $this->isIgnore($e)) { // 不忽略 记录异常到日志去
            Log::debug($e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
        }

        switch (get_class($e)) {
            //认证失败
            case AuthenticationException::class:
                $result = Result::error()->code(CusResultCode::AUTHENTICATION_ERROR['code'])->message($e->getMessage());
                break;
            //laravel 找不到model自动抛出异常
            case ModelNotFoundException::class:
                $result = Result::error()->message('记录不存在!');
                break;
            //参数验证器
            case BizException::class:
            case ValidateException::class:
                $result = Result::error()->message($e->getMessage());
                break;
            //图片上传异常
            case MinioException::class:
            default:
                var_dump($e->getMessage());
                $result = Result::error()->message('系统出小差,请联系系统管理员!');
                break;
        }
        app('response')->setContent($result)->send();
    }
}
