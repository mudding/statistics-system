<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\modules\order\dao\VarietyDao;
use framework\util\Loader;

class VarietyService
{
    /** @var VarietyDao $varietyDao */
    private $varietyDao;

    /**
     * VarietyService constructor.
     */
    public function __construct()
    {
        $this->varietyDao = Loader::singleton(VarietyDao::class);
    }

    /**
     * @param      $accountType
     * @param null $varietyName
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByAccountType($accountType, $varietyName = null)
    {
        return $this->varietyDao->getByAccountType($accountType, $varietyName);
    }

    /**
     * @param $accountType
     * @param $varietyName
     * @return bool
     * @throws \Throwable
     */
    public function create($accountType, $varietyName)
    {
        $isData = $this->getByAccountType($accountType, $varietyName);
        if ($isData->items()) {
            throw new BizException("该账户类型的交易品种已存在！");
        }
        return $this->varietyDao->create($accountType, $varietyName);
    }

    /**
     * @param $id
     * @param $accountType
     * @param $varietyName
     * @return bool
     * @throws \Throwable
     */
    public function update($id, $accountType, $varietyName)
    {
        $isData = $this->getByAccountType($accountType, $varietyName);
        if ($isData->items()) {
            throw new BizException("该账户类型的交易品种已存在！");
        }
        return $this->varietyDao->update($id, $accountType, $varietyName);
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function delete($id)
    {
        return $this->varietyDao->delete($id);
    }
}