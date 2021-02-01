<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\dao;

use app\model\entity\SignalTime;
use app\modules\admin\dao\AdminUserDao;
use framework\db\DB;
use framework\string\StringUtils;

class SignalTimeDao
{
    /**
     * @param null $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getData($name = null)
    {
        return SignalTime::query()->when(!empty($name), function ($query) use ($name) {
            $query->where('signal_time_name', '=', $name);
        })
            ->paginate(100, '*', 'page', 1);
    }

    /**
     * @param $name
     * @return bool
     * @throws \Throwable
     */
    public function create($name)
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($name) {
            SignalTime::query()->create([
                'id' => StringUtils::genGlobalUid(),
                'signal_time_name' => $name
            ]);
        });
        return true;
    }

    /**
     * @param $id
     * @param $name
     * @return bool
     * @throws \Throwable
     */
    public function update($id, $name)
    {
        DB::transaction(AdminUserDao::DB_CONNECTION, function () use ($id, $name) {
            SignalTime::query()->where('id', '=', $id)->update(['signal_time_name' => $name]);
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
            SignalTime::query()->where('id', '=', $id)->delete();
        });
        return true;
    }
}