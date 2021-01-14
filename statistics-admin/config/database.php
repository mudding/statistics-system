<?php
/**
 * This file is part of Monda-PHP.
 */
$host = '172.28.1.57';
$username = 'php';
$password = 'monda123';

return [
    'default' => [
        'host' => env('db_host', $host),
        'driver' => 'mysql',
        'database' => 'monda_asset',
        'username' => env('db_username', $username),
        'password' => env('db_password', $password),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => 'asset_',
    ]
];
