<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\modules\order\dao\AccountDao;
use app\modules\order\vo\AccountVo;
use Carbon\Carbon;
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
     * @param AccountVo $accountVo
     * @return array
     */
    public function getList(AccountVo $accountVo)
    {
        $data = $this->dao->getByType($accountVo->getAccountType(), $accountVo->getAccountNo());
        foreach ($data->items() as $k => $v) {
            $res[$k]['id'] = $v->getOriginal('id');
            $res[$k]['accountType'] = $v->account_type;
            $res[$k]['accountName'] = $v->account_name;
            $res[$k]['accountNo'] = $v->account_no;
            $res[$k]['accountStatus'] = '账户状态实时查询订单日志。空仓';
            $res[$k]['total'] = $v->total;
            $res[$k]['balance'] = $v->balance;
            $res[$k]['frozen'] = $v->frozen;
            $res[$k]['userName'] = $v->user_name;
            $res[$k]['createdAt'] = $v->created_at->toDateTimeString();
            $res[$k]['updatedAt'] = $v->updated_at->toDateTimeString();
        }
        return $res ?? [];
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