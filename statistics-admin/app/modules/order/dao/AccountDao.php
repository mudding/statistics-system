<?php

namespace app\modules\order\dao;

use app\model\entity\Account;
use app\model\entity\AdminUser;
use app\modules\admin\dao\AdminUserDao;
use app\modules\order\vo\AccountCreateVo;
use app\modules\order\vo\AccountUpdateVo;
use app\utils\jwt\JwtUtil;
use Carbon\Carbon;
use framework\db\DB;
use framework\string\StringUtils;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */
class AccountDao
{
    /**
     * @param null $type
     * @param null $no
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByType($type = null, $no = null)
    {
        return Account::query()->when(!empty($no), function ($query) use ($no) {
            $query->where('account_no', 'like', "%{$no}%");
        })
            ->when(!empty($type), function ($query) use ($type) {
                $query->where('account_type', '=', $type);
            })
            ->paginate(50, '*', 'page', 1);
    }

    /**
     * @param AccountCreateVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function create(AccountCreateVo $accountVo)
    {
        $data = [
            'id' => StringUtils::genGlobalUid(),
            'user_id' => JwtUtil::getLoginUser()->getOriginal('id'),
            'account_type' => $accountVo->getAccountType(),
            'account_name' => $accountVo->getAccountName(),
            'account_no' => $accountVo->getAccountNo(),
            'total' => $accountVo->getTotal(),
            'balance' => $accountVo->getTotal(),
            'ratio' => $accountVo->getRatio(),
            'frozen' => 0,
            'user_name' => JwtUtil::getLoginUser()->getOriginal('name')
        ];
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($data) {
            Account::query()->create($data);
        });
        return true;
    }

    /***
     * @param AccountUpdateVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function update(AccountUpdateVo $accountVo)
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($accountVo) {
            $query = Account::query()->where('id', '=', $accountVo->getId());
            $query->increment('total', $accountVo->getTotal());
            $query->increment('balance', $accountVo->getTotal());
            $query->update([
                'user_name' => JwtUtil::getLoginUser()->getOriginal('name'),
                'ratio' => $accountVo->getRatio()
            ]);
        });
        return true;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public static function getById($id)
    {
        return Account::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param $accountId
     * @param $balance
     * @param $frozen
     * @return int
     */
    public static function setAccountTotal($accountId, $balance, $frozen)
    {
        return Account::query()->where('id', '=', $accountId)
            ->update([
                'balance' => $balance,
                'frozen' => $frozen,
            ]);
    }
}