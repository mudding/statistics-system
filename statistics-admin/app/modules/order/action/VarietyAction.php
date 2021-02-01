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

    /**
     * VarietyAction constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(VarietyService::class);
    }

    public function getList($accountType)
    {
        $res = $this->service->getList($accountType);
        return Result::ok()->data($res);
    }

    /**
     * @param $accountType
     * @param $varietyName
     * @return Result
     * @throws \Throwable
     */
    public function create($accountType, $varietyName)
    {
        $res = $this->service->create($accountType, $varietyName);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $id
     * @param $accountType
     * @param $varietyName
     * @return Result
     * @throws \Throwable
     */
    public function update($id, $accountType, $varietyName)
    {
        $res = $this->service->update($id, $accountType, $varietyName);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $id
     * @return Result
     * @throws \Throwable
     */
    public function delete($id)
    {
        $res = $this->service->delete($id);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }
}