<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\vo;

use app\modules\order\validate\AccountValidator;
use framework\vo\RequestVoInterface;

class AccountVo extends BaseVo
{
    /** var string 关联的用户id */
    private $userId;
    /** var string 账户类型,1=外汇,2=期货,3=股票,4=基金 */
    private $accountType;
    /** var string 账户名称 */
    private $accountName;
    /** var string 账户号码 */
    private $accountNo;
    /** var string 总金额(浮动) */
    private $total;
    /** var string 可用余额(浮动) */
    private $balance;
    /** var string 冻结金额-持单的最大亏损金额汇总(浮动) */
    private $frozen;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return empty($this->accountType) ? 0 : $this->accountType;
    }

    /**
     * @param mixed $accountType
     */
    public function setAccountType($accountType): void
    {
        $this->accountType = $accountType;
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @param mixed $accountName
     */
    public function setAccountName($accountName): void
    {
        $this->accountName = $accountName;
    }

    /**
     * @return mixed
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param mixed $accountNo
     */
    public function setAccountNo($accountNo): void
    {
        $this->accountNo = $accountNo;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return mixed
     */
    public function getFrozen()
    {
        return $this->frozen;
    }

    /**
     * @param mixed $frozen
     */
    public function setFrozen($frozen): void
    {
        $this->frozen = $frozen;
    }


    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [];
    }
}