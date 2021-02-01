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
    /** @var AccountService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(AccountService::class);
    }

    public function getList(AccountVo $accountVo)
    {
        $res = $this->service->getList($accountVo);
        return Result::ok()->data($res);
    }
    /**
     * @param AccountVo $accountVo
     * @return Result
     * @throws \Throwable
     */
    public function create(AccountVo $accountVo)
    {
        $res = $this->service->create($accountVo);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $id
     * @param $total
     * @return Result
     * @throws \Throwable
     */
    public function update($id, $total){
        $res = $this->service->updateTotal($id,$total);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }

}