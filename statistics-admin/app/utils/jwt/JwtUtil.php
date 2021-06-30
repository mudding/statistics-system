<?php

namespace app\utils\jwt;

use app\exception\AuthenticationException;
use app\middleware\AuthMiddleWare;
use app\model\entity\AdminUser;
use Carbon\Carbon;
use Exception;
use Firebase\JWT\JWT;
use framework\cache\CacheFactory;
use framework\cache\RedisCache;
use framework\db\Redis;
use framework\request\RequestInterface;
use Predis\Client;

/**
 * Class JwtUtil
 * jwt 生成.
 */
class JwtUtil
{
    /** @var AdminUser $user */
    protected static $user = null;

    /**
     * @param string $loginUserId 登录用户的ID
     * @param string $aud         admin为后端，自定义
     * @param int    $time        以秒为单元
     * @return string jwt
     *                            生成Code
     */
    public function generateCode(string $loginUserId, string $aud, int $time): string
    {
        //token加密
        $tokenParam = [
            'id' => $loginUserId,
            'ip' => app(RequestInterface::class)->getClientIp(),
            'aud' => $aud,
            'iat' => time(),
            'exp' => time() + $time,
        ];
        return JWT::encode($tokenParam, config('rsa.privateKey'), 'RS256');
    }

    /**
     * @param string $token 令牌
     * @param string $aud   admin为后端
     * @return string
     */
    public function parseToken(string $token, string $aud): string
    {
        try {
            $publicKey = config('rsa.publicKey');
            $auth = (array)JWT::decode($token, $publicKey, ['type' => 'RS256']);
            //比较是否过期
            if (isset($auth['exp']) && $auth['exp'] < time()) {
                throw new AuthenticationException('登录超时，请重新登录!');
            }
            //不一致
            if (isset($auth['aud']) && $aud != $auth['aud']) {
                throw new AuthenticationException('登录超时，请重新登录!');
            }
            return $auth['id'];
        } catch (Exception $exception) {
            throw new AuthenticationException('登录超时，请重新登录!');
        }
    }


    /**
     * @return AdminUser
     * @throws Exception
     */
    public static function getLoginUser(): AdminUser
    {
        $adminConfig = config('admin');
//        $token = $_COOKIE['token'] ?? '';
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpZCI6IjAxNjAwOTE4YTUwMzgwYzliYyIsImlwIjoiMTI3LjAuMC4xIiwiYXVkIjoiYWRtaW4iLCJpYXQiOjE2MjUwMTUzNjIsImV4cCI6MTYyNTYyMDE2Mn0.l-jA93FWP-ex2rVtSlC6K-IBQZ7YOJKgur4O-Znjb2_1-xZ0BZgIiYlnOxr4jQPMBHMCuEEm491Tk_TzubJ0TRciyBtRRPm8bH-PBYHfLpD6FpHDSRUXmRJ4ZFumTlb8Gr4TmGH1BacPpBkVt0ZP1Hbs6ecPTCHRPJ4LRhUz1JA';
        return AuthMiddleWare::getUserByToken($token, $adminConfig['redis_login_user_prefix'], $adminConfig['aud']);
    }

}
