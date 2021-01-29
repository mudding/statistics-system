<?php

namespace app\modules\order\dao;

use app\model\entity\Account;
use app\model\entity\AdminUser;
use app\modules\admin\dao\AdminUserDao;
use app\modules\order\vo\AccountVo;
use app\utils\jwt\JwtUtil;
use framework\db\DB;
use framework\string\StringUtils;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */
class AccountDao
{
    /**
     * @param int  $type
     * @param null $no
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByType(int $type = 0, $no = null)
    {
        return Account::query()->when(isset($no), function ($query) use ($no) {
            $query->where('account_no', '=', $no);
        })
            ->when(!empty($type), function ($query) use ($type) {
                $query->where('account_type', '=', $type);
            })
            ->paginate(50, '*', 'page', 1);
    }

    /**
     * @param AccountVo $accountVo
     * @return bool
     * @throws \Throwable
     */
    public function create(AccountVo $accountVo)
    {
        $data = [
            'id' => StringUtils::genGlobalUid(),
            'user_id' => JwtUtil::getLoginUser()->getOriginal('id'),
            'account_type' => $accountVo->getAccountType(),
            'account_name' => $accountVo->getAccountName(),
            'account_no' => $accountVo->getAccountNo(),
            'account_status' => Account::ACCOUNT_STATUS_NULL,
            'total' => $accountVo->getTotal(),
            'balance' => $accountVo->getTotal(),
            'frozen' => 0,
            'user_name' => JwtUtil::getLoginUser()->getOriginal('name')
        ];
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($data) {
            Account::query()->create($data);
        });
        return true;
    }

    /***
     * @param string $id
     * @param float  $total
     * @return bool
     * @throws \Throwable
     */
    public function updateTotal(string $id, float $total)
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($id, $total) {
            $query = Account::query()->where('id', '=', $id);
            $query->increment('total', $total);
            $query->increment('balance', $total);
            $query->update(['user_name' => JwtUtil::getLoginUser()->getOriginal('name')]);
        });
        return true;
    }
}