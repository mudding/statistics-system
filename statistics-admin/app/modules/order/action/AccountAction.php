<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\action;

use app\modules\order\service\AccountService;
use app\modules\order\vo\AccountVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class AccountAction extends Controller
{
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(AccountService::class);
    }

    /**
     * @param AccountVo $accountVo
     * @return Result
     */
    public function create(AccountVo $accountVo)
    {
        $res = $this->service->create($accountVo);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }

}