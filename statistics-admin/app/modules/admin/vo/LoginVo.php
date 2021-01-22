<?php

namespace app\modules\admin\vo;

use app\modules\admin\validate\LoginValidator;
use framework\vo\RequestVoInterface;

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/15
 */
class LoginVo implements RequestVoInterface
{
    private $phone;
    private $password;

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [LoginValidator::class,'login'];
    }
}