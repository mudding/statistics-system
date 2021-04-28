<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\action;

use app\modules\order\service\OrderEndEvaluateService;
use framework\Controller;
use framework\util\Loader;

class OrderEndEvaluateAction extends Controller
{
    /** @var OrderEndEvaluateService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderEndEvaluateService::class);
    }
}