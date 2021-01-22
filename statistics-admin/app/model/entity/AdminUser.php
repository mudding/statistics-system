<?php
namespace app\model\entity;

use framework\db\Model;
/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/15
 */
class AdminUser extends Model
{
    // 是否为超级管理员:1 - 超级管理员 2 - 普通管理员
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