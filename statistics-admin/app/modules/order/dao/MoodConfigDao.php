<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/28
 */

namespace app\modules\order\dao;

use app\model\entity\MoodConfig;
use framework\string\StringUtils;

class MoodConfigDao
{

    /**
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create($value)
    {
        return MoodConfig::query()->create(['id' => StringUtils::genGlobalUid(), 'value' => $value]);
    }

    /**
     * @param $id
     * @param $value
     * @return int
     */
    public function update($id, $value)
    {
        return MoodConfig::query()->where('id', $id)->update(['value' => $value]);
    }

    /**
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getByValue($value)
    {
        return MoodConfig::query()->where('value', $value)->first();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList()
    {
        return MoodConfig::query()->paginate();
    }
}