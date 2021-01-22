<?php

namespace app\utils;

use app\exception\MinioException;
use framework\Controller;
use framework\request\RequestInterface;
use framework\util\Result;
use Minoi\Client\ObjectClient;

/**
 * Class UploadAction
 *
 * @package app\modules\utils\action
 */
class UploadAction extends Controller
{
    /**
     * 上传文件大小.
     * @var int
     */
    private $uploadSize = 50 * 1024 * 1024;

    /**
     * @internal param HttpRequest $request
     */
    public function upload(): Result
    {
        $formKey = 'src';
        if ($_FILES && $_FILES[$formKey] && $_FILES[$formKey]['tmp_name']) {
            $objectClient = new ObjectClient(config('minio'));
            $fileSize = $_FILES[$formKey]['size'];
            //大小限制50M
            if ($fileSize > $this->uploadSize) {
                throw new MinioException('file too large!');
            }
            $originFileName = basename($_FILES['src']['name']);
            $uploadName = generateMiniOFileName($originFileName);
            $res = $objectClient->putObjectBySavePath($_FILES[$formKey]['tmp_name'], $uploadName);
            if (false !== $res) {
                return Result::ok()->message('success')->data([
                    'originFileName' => strlen($originFileName) > 32 ? date('YmdHis') : $originFileName,
                    'path' => $res,
                    'size' => $fileSize,
                    'url' => $objectClient->getObjectUrl($res),
                ]);
            }
        }
        throw new MinioException('upload error');
    }

    /**
     * @param RequestInterface $request
     * @return Result
     */
    public function getResUrl(RequestInterface $request): Result
    {
        $imgUrl = $request->getParameter('imgUrl');
        if (empty($imgUrl)) {
            return Result::error()->message('参数imgUrl不能为空');
        }
        $resUrl = Helper::getResUrl($imgUrl);
        if (! Helper::validUrl($resUrl)) {
            return Result::error()->message('图片不存在');
        }
        return Result::ok()->data(['resUrl' => $resUrl]);
    }
}
