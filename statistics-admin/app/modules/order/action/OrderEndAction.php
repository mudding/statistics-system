<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\OrderEndService;
use framework\Controller;
use framework\util\Loader;

class OrderEndAction extends Controller
{
    /** @var OrderEndService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderEndService::class);
    }
}