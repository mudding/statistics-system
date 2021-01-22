<?php

namespace app\modules\admin\service;

use app\exception\BizException;
use app\model\entity\AdminUser;
use app\modules\admin\dao\AdminUserDao;
use app\modules\admin\dto\AdminUserDto;
use app\modules\admin\vo\AdminUserVo;
use Carbon\Carbon;
use framework\string\StringUtils;
use framework\util\Loader;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/15
 */
class AdminUserService
{

    /**
     * @var  AdminUserDao $adminUserDao
     */
    private $adminUserDao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->adminUserDao = Loader::singleton(AdminUserDao::class);
    }

    /**
     * 根据手机号码查找用户.
     *
     * @param $phone
     * @return mixed
     */
    public function getUserByPhone($phone)
    {
        return $this->adminUserDao->getUserByPhoneDao($phone);
    }

    /**
     * 更新登录的信息
     *
     * @param AdminUser $user
     */
    public function updateLoginInfo(AdminUser $user): void
    {
        $this->adminUserDao->updateLoginInfoDao($user);
    }

    /**
     * @param AdminUserVo $adminUserVo
     * @return mixed
     * @throws \Throwable
     */
    public function create(AdminUserVo $adminUserVo)
    {
        $isData = $this->getUserByPhone($adminUserVo->getPhone());
        if ($isData) {
            throw new BizException("该手机号码已注册！！！请重新输入手机号码");
        }
        $password = makePassword($adminUserVo->getPassword());
        return $this->adminUserDao->create($adminUserVo->getName(), $adminUserVo->getPhone(), $password);
    }
}