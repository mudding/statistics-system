<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\VarietyService;
use app\modules\order\vo\VarietyVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class VarietyAction extends Controller
{
    /** @var VarietyService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(VarietyService::class);
    }

    /**
     * @param VarietyVo $varietyVo
     * @return Result
     */
    public function create(VarietyVo $varietyVo)
    {
        $res = $this->service->create($varietyVo);
        if ($res){
            return Result::ok();
        }
        return Result::error();
    }
}