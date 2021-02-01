<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\action;

use app\modules\order\service\SignalTimeService;
use framework\Controller;
use framework\util\Loader;
use framework\util\Result;

class SignalTimeAction extends Controller
{
    /** @var SignalTimeService $service */
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(SignalTimeService::class);
    }

    public function getList()
    {
        $res = $this->service->getList();
        return Result::ok()->data($res);
    }

    /**
     * @param $name
     * @return Result
     * @throws \Throwable
     */
    public function create($name)
    {
        $res = $this->service->create($name);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $id
     * @param $name
     * @return Result
     * @throws \Throwable
     */
    public function update($id, $name)
    {
        $res = $this->service->update($id, $name);
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