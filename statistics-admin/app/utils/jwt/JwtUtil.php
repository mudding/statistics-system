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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpZCI6IjAxNjAwOTE4YTUwMzgwYzliYyIsImlwIjoiMTI3LjAuMC4xIiwiYXVkIjoiYWRtaW4iLCJpYXQiOjE2MTk1MDcwMDIsImV4cCI6MTYyMDExMTgwMn0.CRtT4ldR5Gq9hrJvjSAPrayKteCLZX2p41M3XKK1QkvPmw4rytxBJ6CvIrdi1nf9RyJdO7lJhkKgx1_aHADf-GW-Er3tIGA87I6Rph5OT7xWVoinA-UOJZKbRx-3WyUkjjXEaNYHqOzptQSaIpsBptD1iyUEo3VjuiJcK72up8g';
        return AuthMiddleWare::getUserByToken($token, $adminConfig['redis_login_user_prefix'], $adminConfig['aud']);
    }

}
