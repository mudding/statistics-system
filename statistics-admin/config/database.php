<?php
/**
 * This file is part of Monda-PHP.
 */
$host = '127.0.0.1';
$username = 'root';
$password = 'a123456789';

return [
    'default' => [
        'host' => env('db_host', $host),
        'driver' => 'mysql',
        'database' => 'statistics_system',
        'username' => env('db_username', $username),
        'password' => $password ,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];
