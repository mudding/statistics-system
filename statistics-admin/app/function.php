<?php

// 公共函数库

/**
 * 密码加密方式.
 */
if (! function_exists('makePassword')) {
    function makePassword($str): string
    {
        return md5(md5($str));
    }
}

/**
 * @param $key
 * @return mixed
 * 获取http头信息
 */
if (! function_exists('getHttpHeader')) {
    function getHttpHeader($key)
    {
        $key = 'HTTP_' . str_replace('-', '_', strtoupper($key));
        return isset($_SERVER[$key]) ? $_SERVER[$key] : '';
    }
}

/**
 * 树行结构
 * @author chenzifan
 */
if (! function_exists('tree')) {
    function tree($arr, $pid = 0, $isIdAsKey = false)
    {
        $tree = [];
        foreach ($arr as $row) {
            if ($row['pid'] == $pid) {
                if (! isset($row['isUser'])) {
                    $tmp = tree($arr, $row['id'], $isIdAsKey);
                    if ($tmp) {
                        $row['children'] = $tmp;
                    }
                }
                if ($isIdAsKey == true && isset($row['id'])) {
                    $tree[$row['id']] = $row;
                } else {
                    $tree[] = $row;
                }
            }
        }
        return $tree;
    }
}

/**
 * 浮点值加法
 */
if (! function_exists('floatBcadd')) {
    function floatBcadd($left, $right)
    {
        return floatval(bcadd($left, $right, 5));
    }
}

/**
 * 浮点值减法
 */
if (! function_exists('floatBcsub')) {
    function floatBcsub($left, $right)
    {
        return floatval(bcsub($left, $right, 5));
    }
}

/**
 * 浮点值除法
 */
if (! function_exists('floatBcdiv')) {
    function floatBcdiv($left, $right)
    {
        return floatval(bcdiv($left, $right, 5));
    }
}

/**
 * 浮点值乘法
 */
if (! function_exists('floatBcuml')) {
    function floatBcuml($left, $right)
    {
        return floatval(bcmul($left, $right, 5));
    }
}


/**
 * 获取当前域名包括http
 */
if (!function_exists('getDomain')) {
    function getDomain()
    {
        $httpType = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $httpHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        return $httpType . $httpHost;
    }
}
