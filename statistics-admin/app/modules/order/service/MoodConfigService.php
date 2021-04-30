<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/28
 */

namespace app\modules\order\service;

use app\exception\BizException;
use app\model\entity\MoodConfig;
use app\modules\order\dao\MoodConfigDao;
use framework\util\Loader;

class MoodConfigService
{
    /** @var MoodConfigDao $dao */
    private $dao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->dao = Loader::singleton(MoodConfigDao::class);
    }

    public function create($value)
    {
        $mood = $this->dao->getByValue($value);
        if (!empty($mood)) {
            throw  new BizException('该值已存在！');
        }
        return $this->dao->create($value);
    }

    public function update($id, $value)
    {
        return $this->dao->update($id, $value);
    }

    public function getList()
    {
        $moodList = $this->dao->getList();
        /** @var MoodConfig $mood */
        foreach ($moodList->items() as $mood) {
            $data[] = [
                'id' => $mood->getOriginal('id'),
                'value' => $mood->value
            ];
        }
        return $data ?? [];
    }
}