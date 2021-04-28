<?php

namespace app\model\entity;

use Carbon\Carbon;
use framework\db\Model;

/**
 * Class AdminUser
 *
 * @package app\model\entity
 * @property string|null    $id
 * @property string|null    $name              名称
 * @property string|null    $phone             手机
 * @property string|null    $password          密码
 * @property string|null    $login_count       登陆次数
 * @property string|null    $is_super_admin    是否超级管理员
 * @property string|null    $last_login_time   最后登陆时间
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property AdminUser      $adminUser
 */
class AdminUser extends Model
{

    /* --- 是否为超级管理员  --- */
    /** @var int 超级管理员 */
    public const IS_SUPER_ADMIN = 1;
    /** @var int 普通管理员 */
    public const IS_NOT_SUPER_ADMIN = 2;

    protected $primaryKey = 'id';

    protected $table = 'admin_user';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'password',
        'login_count',
        'is_super_admin',
        'last_login_time',
        'created_at',
        'updated_at'
    ];

}