<?php
/**
 * This file is part of Monda-PHP.
 *
 */
namespace app\middleware;

use app\exception\AuthenticationException;
use app\model\entity\AdminUser;
use app\modules\admin\dao\system\AdminUserDao;
use app\utils\jwt\JwtUtil;
use framework\cache\CacheFactory;
use framework\cache\RedisCache;
use framework\util\Loader;

/**
 * 模块中间件
 * Class AuthMiddleWare.
 */
class AuthMiddleWare
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, \Closure $next)
    {
        $adminConfig = config('admin');
        $headerToken = getHttpHeader($adminConfig['header_name']);
        if (empty($headerToken)) {
            throw new AuthenticationException('请先登录授权!');
        }
        $user = $this->parseToken($headerToken, $adminConfig['redis_login_user_prefix'], $adminConfig['aud']);
        /* todo 验证路由权限 */
        return $next($request);
    }

    /**
     * 解析token
     * @param string $token
     * @param string $prefix
     * @param string $aud
     * @return AdminUser
     * @throws \Exception
     */
    private function parseToken(string $token, string $prefix, string $aud): AdminUser
    {
        $redisKey = $prefix . md5($token);
        /* @var RedisCache $redisCache */
        $redisCache = CacheFactory::create(RedisCache::class);
        $user = $redisCache->get($redisKey);
        if (empty($user)) {
            /** @var AdminUserDao $AdminUserDao*/
            $AdminUserDao = Loader::singleton(AdminUserDao::class);
            $useId = (new JwtUtil())->parseToken($token, $aud);
            $user = $AdminUserDao->findDao($useId);
            if (empty($user)) {
                throw new AuthenticationException('用户不存在，请重新登录!');
            }
            $redisCache->set($redisKey, $user, 86400);
        }
        return $user;
    }
}
