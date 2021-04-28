<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\model\entity\Variety;
use app\modules\order\dao\VarietyDao;
use framework\util\Loader;

class VarietyService
{
    /** @var VarietyDao $dao */
    private $dao;

    /**
     * VarietyService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(VarietyDao::class);
    }

    /**
     * @param $accountType
     * @return array
     */
    public function getList($accountType)
    {
        $data = $this->dao->getByAccountType($accountType);
        /** @var Variety $v */
        foreach ($data->items() as $k => $v) {
            $res[$k]['id'] = $v->getOriginal('id');
            $res[$k]['accountType'] = $v->account_type;
            $res[$k]['varietyName'] = $v->variety_name;
        }
        return $res ?? [];
    }

    /**
     * @param      $accountType
     * @param null $varietyName
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByAccountType($accountType, $varietyName = null)
    {
        return $this->dao->getByAccountType($accountType, $varietyName);
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
        return $this->dao->create($accountType, $varietyName);
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
        return $this->dao->update($id, $accountType, $varietyName);
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