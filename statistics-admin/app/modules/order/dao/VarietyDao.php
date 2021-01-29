<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\dao;

use app\model\entity\Variety;
use app\modules\admin\dao\AdminUserDao;
use framework\db\DB;
use framework\string\StringUtils;

class VarietyDao
{
    /**
     * @param      $accountType
     * @param null $varietyName
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByAccountType($accountType, $varietyName = null)
    {
        return Variety::query()->where('account_type', '=', $accountType)
            ->when(!empty($varietyName), function ($query) use ($varietyName) {
                $query->where('variety_name', '=', $varietyName);
            })
            ->paginate(100, '*', 'page', 1);
    }

    /**
     * @param $accountType
     * @param $varietyName
     * @return bool
     * @throws \Throwable
     */
    public function create($accountType, $varietyName): bool
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($accountType, $varietyName) {
            Variety::query()->create([
                'id' => StringUtils::genGlobalUid(),
                'account_type' => $accountType,
                'variety_name' => $varietyName,
            ]);
        });
        return true;
    }

    /**
     * @param $id
     * @param $accountType
     * @param $varietyName
     * @return bool
     * @throws \Throwable
     */
    public function update($id, $accountType, $varietyName): bool
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($id, $accountType, $varietyName) {
            Variety::query()->where('id', '=', $id)
                ->update([
                    'account_type' => $accountType,
                    'variety_name' => $varietyName,
                ]);
        });
        return true;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function delete($id)
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($id) {
            Variety::query()->where('id', '=', $id)->delete();
        });
        return true;
    }
}