<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\OrderService;
use app\modules\order\service\OrderSystemFormulaService;
use app\modules\order\vo\OrderCreateVo;
use app\modules\order\vo\OrderSystemFormulaVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class OrderAction extends Controller
{
    /** @var OrderService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(OrderService::class);
    }

    public function create(OrderCreateVo $orderLogVo)
    {
        $res = $this->service->create($orderLogVo);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    public function getSystemFormula(OrderSystemFormulaVo $systemFormulaVo)
    {
        $systemFormulaVo->checkParameter();
        /** @var  OrderSystemFormulaService $service */
        $service = Loader::service(OrderSystemFormulaService::class);
        $data = $service->getSystemFormula($systemFormulaVo);
        return Result::ok()->data($data);
    }

}