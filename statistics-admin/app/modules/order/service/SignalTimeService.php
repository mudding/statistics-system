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
    /** @var SignalTimeDao $dao */
    private $dao;

    /**
     * SignalTimeService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(SignalTimeDao::class);
    }

    /**
     * @return array
     */
    public function getList()
    {
        $data = $this->dao->getData();
        foreach ($data->items() as $k => $v) {
            $res[$k]['id'] = $v->getOriginal('id');
            $res[$k]['signalTimeName'] = $v->signal_time_name;
        }
        return $res ?? [];
    }

    /**
     * @param null $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSignalTimeName($name = null)
    {
        return $this->dao->getData($name);
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
        return $this->dao->create($name);
    }

    /**
     * @param $id
     * @param $name
     * @return bool
     * @throws \Throwable
     */
    public function update($id, $name)
    {
        return $this->dao->update($id, $name);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function delete($id)
    {
        return $this->dao->delete($id);
    }

}