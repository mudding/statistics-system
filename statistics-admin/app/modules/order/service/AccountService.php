<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\AccountDao;
use framework\util\Loader;

class AccountService
{
   /** @var AccountDao $accountDao  */
    private $accountDao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->accountDao = Loader::singleton(AccountDao::class);
    }
}