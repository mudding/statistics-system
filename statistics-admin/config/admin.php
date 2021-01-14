<?php
/**
 * 登陆配置
 *
 */
return [

    /*
    * jwt aud
    */
    'aud' => 'admin',
    /*
     * cookie name
     * @var string
     */
    'header_name' => 'authorize-admin',

    /*
     * token expire time
     */
    'token_expire_time' => 86400 * 7,

    /*
     * 当前登录用户redisKey 前缀md5
     */
    'redis_login_user_prefix' => 'loginUser:',
];
