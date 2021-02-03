<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\OrderLogService;
use app\modules\order\vo\OrderLogVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class OrderLogAction extends Controller
{
    /** @var OrderLogService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderLogService::class);
    }

    public function create(OrderLogVo $orderLogVo)
    {
        $res = $this->service->create($orderLogVo);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }

}