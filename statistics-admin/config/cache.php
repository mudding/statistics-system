<?php
/**
 * This file is part of Monda-PHP.
 *
 */
return [
    'default' => 'file',

    //文件缓存
    'file' => [
        'cache_dir' => RUNTIME_PATH . '/cache/',
        'cache_per' => '0777',
    ],
    //redis
    'redis' => [
        'parameters' => [
            'scheme' => 'tcp',
            'host' => env('redis_hostname', '172.28.1.3'),
            'port' => env('redis_port', '6379'),
        ],
        'options' => [
            'prefix' => 'monda:',
            'parameters' => [
                'password' => '',
                'database' => 11,
            ],
        ],
    ],
];
