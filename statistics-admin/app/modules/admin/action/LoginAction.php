<?php
namespace app\modules\admin\action;

use app\modules\admin\service\AdminUserService;
use app\modules\admin\vo\LoginVo;
use app\utils\jwt\JwtUtil;
use framework\Controller;
use framework\crypt\RSACrypt;
use framework\util\Loader;
use framework\util\Result;

class LoginAction extends Controller
{
    /* @var RSACrypt $rsa */
    private $rsa;

    /**
     * 配置文件数组
     * @var array
     */
    private $adminConfig;

    /**
     * 初始化
     */
    public function _initialize(): void
    {
        $this->rsa = new RSACrypt();
        $this->adminConfig = config('admin');
    }

    /**
     * 登录
     * @param LoginVO $loginVO
     * @return Result
     */
    public function login(LoginVO $loginVO): Result
    {
        /* @var AdminUserService $adminUserService */
        $adminUserService = Loader::service(AdminUserService::class);
        $adminUser = $adminUserService->getUserByPhone($loginVO->getPhone());
        if (is_null($adminUser)) {
            return Result::error()->message('请检查手机号码是否填写正确!');
        }
        $decryptPassword = makePassword($loginVO->getPassword());
        if ($decryptPassword !== $adminUser->password) {
            return Result::error()->message('账号或者密码错误,请检查是否填写正确!');
        }
        $token = (new JwtUtil())->generateCode($adminUser->id, $this->adminConfig['aud'], $this->adminConfig['token_expire_time']);
        //更新登录信息
        $adminUserService->updateLoginInfo($adminUser);
        return Result::ok()->data([
            'token' => $token,
            'phone' => $loginVO->getPhone(),
            'isSuperAdmin' => (int)$adminUser->is_super_admin,
            'headerName' => $this->adminConfig['header_name'],
        ]);
    }

    /**
     * 退出登录.
     */
    public function logout(): Result
    {
        getHttpHeader($this->adminConfig['header_name']);
        return Result::ok()->message('退出成功');
    }
}
