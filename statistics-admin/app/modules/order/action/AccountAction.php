<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\action;

use app\model\entity\Account;
use app\modules\order\service\AccountService;
use app\modules\order\vo\AccountCreateVo;
use app\modules\order\vo\AccountUpdateVo;
use framework\Controller;
use framework\request\RequestInterface;
use framework\util\Loader;
use framework\util\Result;

class AccountAction extends Controller
{
    /** @var AccountService $service */
    protected $service;

    /**
     * AccountAction constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = Loader::service(AccountService::class);
    }

    /**
     * @param RequestInterface $request
     * @return Result
     */
    public function getList(RequestInterface $request)
    {
        $accountType = $request->getParameter('accountType');
        $accountNo = $request->getParameter('accountNo');
        $res = $this->service->getList($accountType, $accountNo);
        $extra['accountType'] = Account::ACCOUNT_TYPE;
        return Result::ok()->data($res)->extra($extra);
    }

    /**
     * @param AccountCreateVo $accountVo
     * @return Result
     * @throws \Throwable
     */
    public function create(AccountCreateVo $accountVo)
    {
        $res = $this->service->create($accountVo);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param AccountUpdateVo $accountUpdateVo
     * @return Result
     * @throws \Throwable
     */
    public function update(AccountUpdateVo $accountUpdateVo)
    {
        $res = $this->service->update($accountUpdateVo);
        if ($res) {
            return Result::ok();
        }
        return Result::error();
    }

    /**
     * @param $accountId
     * @return Result
     */
    public function getMaxLossAmount($accountId)
    {
        $res = $this->service->getMaxLossAmount($accountId);
        return Result::ok()->data($res);
    }

}