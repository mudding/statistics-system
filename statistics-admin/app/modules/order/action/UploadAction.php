<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/7/1
 */

namespace app\modules\order\action;


use framework\Controller;
use framework\file\FileUpload;
use framework\string\StringUtils;
use framework\util\Result;


class UploadAction extends Controller
{
    /**
     * 文件上传
     */
    public function upload()
    {
        $fileName = $_FILES['src']['name'];
        $filePath = '/images' . date('Y') . '/' . date('m') . '/' . date('d');
//        $config = [
//            'upload_dir' => UPLOAD_PATH . $filePath,
//            //允许上传的文件类型
//            'allow_ext' => FileUploadConstant::FILE_ALLOW_EXT,
//            //允许上传的图片类型
//            'allow_type' => FileUploadConstant::FILE_ALLOW_TYPE,
//            //图片的最大宽度, 0没有限制
//            'max_width' => 0,
//            //图片的最大高度, 0没有限制
//            'max_height' => 0,
//            //文件的最大尺寸
//            'max_size' => FileUploadConstant::FILE_MAX_SIZE,
//        ];
        $tmpName = StringUtils::genGlobalUid();
        $upload = new FileUpload($fileName, $tmpName);
        $result = $upload->move($filePath);
        if ($result) {
            $path = '/' . $filePath . '/' . $result['file_name'];
            return Result::ok()->data([
                'path' => $path,
                'httpPath' => getDomain() . $path,
            ]);
        }
        return Result::error();
    }
}