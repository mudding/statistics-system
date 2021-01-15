<?php
/**
 * minio文件对象存储配置
 *
 */
return [

        'key' => env('minio_key', 'minioadmin'),
        'secret' => env('minio_secret', 'minioadmin'),
        'region' => env('minio_region', ''),
        'version' => 'latest',
        'endpoint' => env('minio_endpoint', 'http://127.0.0.1:9000'),
        'bucket' => env('minio_bucket', 'test'),
];
