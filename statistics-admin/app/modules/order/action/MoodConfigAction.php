<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/28
 */

namespace app\modules\order\action;

use app\modules\order\service\MoodConfigService;
use app\modules\order\service\OrderService;
use app\modules\order\vo\OrderCreateVo;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class MoodConfigAction extends Controller
{
    /** @var MoodConfigService $service */
    protected $service;

    /**
     * MoodConfigAction constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(MoodConfigService::class);
    }

    /**
     * @param $value
     * @return Result
     */
    public function create($value)
    {
        $res = $this->service->create($value);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $id
     * @param $value
     * @return Result
     */
    public function update($id, $value)
    {
        $res = $this->service->update($id, $value);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @return Result
     */
    public function getList()
    {
        return Result::ok()->data($this->service->getList());
    }

}