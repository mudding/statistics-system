<?php

namespace app\utils\jwt;

use app\exception\AuthenticationException;
use Carbon\Carbon;
use Exception;
use Firebase\JWT\JWT;
use framework\db\Redis;
use framework\request\RequestInterface;
use Predis\Client;

/**
 * Class JwtUtil
 * jwt 生成.
 */
class JwtUtil
{

    /**
     * @param string $loginUserId 登录用户的ID
     * @param string $aud admin为后端，自定义
     * @param int $time 以秒为单元
     * @return string jwt
     *  生成Code
     */
    public function generateCode(string $loginUserId, string $aud, int $time): string
    {
        //token加密
        $tokenParam = [
            'id' => $loginUserId,
            'ip' => app(RequestInterface::class)->getClientIp(),
//            'iss' => 'mondaGroup',
            'aud' => $aud,
            'iat' => time(),
            'exp' => time() + $time,
        ];
        return JWT::encode($tokenParam, config('rsa.privateKey'), 'RS256');
    }

    /**
     * @param string $token 令牌
     * @param string $aud admin为后端
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

}
