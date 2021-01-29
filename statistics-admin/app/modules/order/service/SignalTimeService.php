<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\modules\order\dao\SignalTimeDao;
use framework\util\Loader;

class SignalTimeService
{
    /** @var SignalTimeDao $signalTimeDao */
    private $signalTimeDao;

    /**
     * SignalTimeService constructor.
     */
    public function __construct()
    {
        $this->signalTimeDao = Loader::singleton(SignalTimeDao::class);
    }

    /**
     * @param null $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSignalTimeName($name = null)
    {
        return $this->signalTimeDao->get($name);
    }

    /**
     * @param string $name
     * @return bool
     * @throws \Throwable
     */
    public function create(string $name)
    {
        $isData = $this->getSignalTimeName($name);
        if ($isData->items()) {
            throw new BizException("该周期已存在！");
        }
        return $this->signalTimeDao->create($name);
    }

    /**
     * @param $id
     * @param $name
     * @return bool
     * @throws \Throwable
     */
    public function update($id, $name)
    {
        return $this->signalTimeDao->update($id, $name);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function delete($id)
    {
        return $this->signalTimeDao->delete($id);
    }

}