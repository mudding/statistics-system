<?php
namespace app\modules\admin\action;

use framework\Controller;

class IndexAction extends Controller
{
    public function index() :array
    {
        return [
            'age' => '测试返回数据'
        ];
    }
}
