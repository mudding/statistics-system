<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\service;

use app\modules\order\dao\SignalTimeDao;
use framework\util\Loader;

class SignalTimeService
{
    /** @var SignalTimeDao $signalTimeDao */
    private $signalTimeDao;

    /**
     * AdminUserService constructor.
     */
    public function __construct()
    {
        $this->signalTimeDao = Loader::singleton(SignalTimeDao::class);
    }
}