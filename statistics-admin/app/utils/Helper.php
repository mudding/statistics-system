<?php

namespace app\utils;

use app\exception\BizException;
use framework\string\StringUtils;
use Minoi\Client\ObjectClient;

/**
 * 跟业务相关的方法
 * 区别：functions 是跟业务方法不相关的
 */
class Helper
{
    /**
     * 获取上传后的url
     *
     * @param  $path
     * @return string
     */
    public static function getResUrl($path): string
    {
        if (empty($path)) {
            return '';
        }
        return config('minio')['imageUrl'] . '/asset/' . $path;
    }

    /**
     * 获取图片path
     *
     * @param $resUrl
     * @return string
     */
    public static function getImgUrl($resUrl): string
    {
        if (!empty($resUrl)) {
            preg_match('/\d{4}\/\d{2}\/\d{2}\/[a-z0-9]*\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)/', $resUrl,
                $matches);
            return $matches[0];
        }
        return "";
    }


    public static function remove($path): bool
    {
        if (empty($path)) {
            throw new BizException('路径为空');
        }
        $objectClient = new ObjectClient(config('minio'));
        return $objectClient->removeObject($path);
    }

    /**
     * 查看资源是否有效
     *
     * @param $url
     * @return bool
     */
    public static function validUrl($url): bool
    {
        $array = get_headers($url, 1);
        return false !== strpos($array[0], '200');
    }

    /**
     * @param $items
     * @param $id
     * @return string
     * 找到上级的所有id
     */
    public static function getParentIds($items, $id): string
    {
        $parentIds = [];
        while ($id != 0) {
            foreach ($items ?? [] as $item) {
                if ($item['id'] == $id) {
                    $parentIds[] = $id;
                    $id = $item['pid'];
                    break;
                }
            }
        }
        return StringUtils::jsonEncode($parentIds);
    }

}
