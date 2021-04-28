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

    public function create($value)
    {
        return MoodConfig::query()->create(['id' => StringUtils::genGlobalUid(), 'value' => $value]);
    }

    public function update($id, $value)
    {
        return MoodConfig::query()->where('id', $id)->update(['value' => $value]);
    }

    public function getList()
    {
        return MoodConfig::query()->paginate();
    }
}