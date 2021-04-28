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
 * 浮点值乘法
 */
if (! function_exists('floatBcuml')) {
    function floatBcuml($left, $right)
    {
        return floatval(bcmul($left, $right, 5));
    }
}