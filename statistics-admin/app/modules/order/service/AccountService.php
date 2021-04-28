<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\model\entity\Account;
use app\modules\order\dao\AccountDao;
use app\modules\order\vo\AccountCreateVo;
use app\modules\order\vo\AccountUpdateVo;
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
     * @param $accountType
     * @param $accountNo
     * @return array
     */
    public function getList($accountType, $accountNo)
    {
        $data = $this->dao->getByType($accountType, $accountNo);
        /** @var Account $v */
        foreach ($data->items() as $k => $v) {
            $res[$k]['id'] = $v->getOriginal('id');
            $res[$k]['accountType'] = $v->account_type;
            $res[$k]['accountName'] = $v->account_name;
            $res[$k]['accountNo'] = $v->account_no;
            $res[$k]['accountStatus'] = '账户状态实时查询订单日志。空仓';
            $res[$k]['total'] = $v->total;
            $res[$k]['balance'] = $v->balance;
            $res[$k]['frozen'] = $v->frozen;
            $res[$k]['ratio'] = floatval($v->ratio);
            $res[$k]['rati'] = floatBcuml($v->ratio, 100) . '%';
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
     * @param AccountCreateVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function create(AccountCreateVo $accountVo)
    {
        $isData = $this->getByType($accountVo->getAccountType(), $accountVo->getAccountNo());
        if ($isData->items()) {
            throw new BizException("该账户类型中的账户已存在！");
        }
        return $this->dao->create($accountVo);
    }

    /**
     * @param AccountUpdateVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function update(AccountUpdateVo $accountVo)
    {
        return $this->dao->update($accountVo);
    }

    /**
     * @param $accountId
     * @return float
     */
    public function getMaxLossAmount($accountId)
    {
        /** @var Account $data */
        $data = $this->dao->getById($accountId);
        return floatBcuml($data->balance, $data->ratio);
    }


}