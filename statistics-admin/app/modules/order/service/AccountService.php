<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\modules\order\dao\AccountDao;
use app\modules\order\vo\AccountVo;
use framework\util\Loader;

class AccountService
{
    /** @var AccountDao $dao */
    private $dao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(AccountDao::class);
    }

    /**
     * @param int  $type
     * @param null $no
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByType(int $type, $no = null)
    {
        return $this->dao->getByType($type, $no);
    }

    /**
     * @param AccountVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function create(AccountVo $accountVo)
    {
        $isData = $this->getByType($accountVo->getAccountType(), $accountVo->getAccountNo());
        if ($isData->items()) {
            throw new BizException("该账户类型中的账户已存在！");
        }
        return $this->dao->create($accountVo);
    }

    /**
     * @param string $id
     * @param float  $total
     * @return bool
     * @throws \Throwable
     */
    public function updateTotal(string $id, float $total)
    {
        return $this->dao->updateTotal($id, $total);
    }

}