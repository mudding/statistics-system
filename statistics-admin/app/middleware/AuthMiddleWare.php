<?php
/**
 * This file is part of Monda-PHP.
 *
 */

namespace app\middleware;

use app\exception\AuthenticationException;
use app\model\entity\AdminUser;
use app\modules\admin\dao\AdminUserDao;
use app\utils\bean\BeanUtil;
use app\utils\jwt\JwtUtil;
use Carbon\Traits\Serialization;
use framework\cache\CacheFactory;
use framework\cache\RedisCache;
use framework\string\StringUtils;
use framework\util\Loader;

/**
 * 模块中间件
 * Class AuthMiddleWare.
 */
class AuthMiddleWare
{
    /** @var AdminUser $user */
    protected static $user;

    /**
     * @param          $request
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
        $user = self::getUserByToken($headerToken, $adminConfig['redis_login_user_prefix'], $adminConfig['aud']);
        /* todo 验证路由权限 */
        return $next($request);
    }

    /**
     * 解析token
     *
     * @param string $token
     * @param string $prefix
     * @param string $aud
     * @return AdminUser
     * @throws \Exception
     */
    public static function getUserByToken(string $token, string $prefix, string $aud): AdminUser
    {
        if (!is_null(static::$user)) {
            return static::$user;
        }
        /* @var RedisCache $redisCache */
        $redisCache = CacheFactory::create(RedisCache::class);
        $redisKey = $prefix . md5($token);
        $user = $redisCache->get($redisKey);
        if (empty($user)) {
            /** @var AdminUserDao $AdminUserDao */
            $AdminUserDao = Loader::singleton(AdminUserDao::class);
            $useId = (new JwtUtil())->parseToken($token, $aud);
            $user = $AdminUserDao->findById($useId);
            if (empty($user)) {
                throw new AuthenticationException('用户不存在，请重新登录!');
            }
            $redisCache->set($redisKey, serialize($user), 86400);
            static::$user = $user;
            return static::$user;
        }
        return unserialize($user);
    }
}
