<?php

namespace app\modules\admin\dao;

use app\model\entity\AdminUser;
use Carbon\Carbon;
use framework\db\DB;
use framework\request\RequestInterface;
use framework\string\StringUtils;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/15
 */
class AdminUserDao
{
    const DB_CONNECTION = 'default';

    /**
     * 根据手机号码查找用户.
     *
     * @param $phone
     * @return mixed
     */
    public function getUserByPhoneDao($phone)
    {
        return AdminUser::query()->where('phone', $phone)->first();
    }

    /**
     * @param AdminUser $user
     *  更新登录的信息
     */
    public function updateLoginInfoDao(AdminUser $user): void
    {
        AdminUser::query()->where('id', $user->getOriginal('id'))->update([
            'login_count' => $user->getOriginal('login_count') + 1,
            'last_login_time' => Carbon::now()
        ]);
    }

    /**
     * @param string $id
     * @return mixed
     *  根据id查找
     */
    public function findById(string $id)
    {
        return AdminUser::query()->where('id', $id)->first();
    }

    /**
     * @param $name
     * @param $phone
     * @param $password
     * @return bool
     * @throws \Throwable
     */
    public function create($name, $phone, $password): bool
    {
        DB::transaction(self::DB_CONNECTION, function () use ($name, $phone, $password) {
            AdminUser::query()->create([
                'id' => StringUtils::genGlobalUid(),
                'name' => $name,
                'phone' => $phone,
                'password' => $password,
                'login_count' => 0,
                'is_super_admin' => AdminUser::IS_NOT_SUPER_ADMIN,
                'last_login_time' => Carbon::now()->toDateTimeString(),
            ]);
        });
        return true;
    }

}