<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\admin\action;

use app\modules\admin\service\AdminUserService;
use app\modules\admin\vo\AdminUserVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class AdminUserAction extends Controller
{
    /* @var AdminUserService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(AdminUserService::class);
    }

    /**
     * @param AdminUserVo $adminUserVo
     * @return Result
     */
    public function create(AdminUserVo $adminUserVo)
    {
        $res = $this->service->create($adminUserVo);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }

}