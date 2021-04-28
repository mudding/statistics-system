<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\vo;

use app\modules\order\validate\AccountValidator;
use framework\vo\RequestVoInterface;

class AccountCreateVo extends BaseVo
{
    /**  string 账户类型,1=外汇,2=期货,3=股票,4=基金 */
    private $accountType;
    /**  string 账户名称 */
    private $accountName;
    /**  string 账户号码 */
    private $accountNo;
    /**  string 总金额(浮动) */
    private $total;
    /**  string 系数 */
    private $ratio;
    /** string 额外的倍数 */
    private $otherMultiple;
    
    /**
     * @return array|string[]
     */
    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [AccountValidator::class, 'create'];
    }

    /**
     * @return mixed
     */
    public function getOtherMultiple()
    {
        return $this->otherMultiple;
    }

    /**
     * @param mixed $otherMultiple
     */
    public function setOtherMultiple($otherMultiple): void
    {
        $this->otherMultiple = $otherMultiple;
    }


    /**
     * @return mixed
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param mixed $ratio
     */
    public function setRatio($ratio): void
    {
        $this->ratio = $ratio;
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


}