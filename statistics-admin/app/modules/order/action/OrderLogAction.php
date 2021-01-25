<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\OrderLogService;
use framework\Controller;
use framework\util\Loader;

class OrderLogAction extends Controller
{
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderLogService::class);
    }
}