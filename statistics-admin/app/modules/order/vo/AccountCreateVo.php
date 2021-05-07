<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\vo;

use app\modules\order\validate\AccountValidator;

class AccountCreateVo extends BaseVo
{
    /**  string 账户类型,1=外汇,2=期货,3=期权,4=股票,5=基金,6=美股港股,7=虚拟币 */
    private $accountType;
    /**  string 账户名称 */
    private $accountName;
    /**  string 账户号码 */
    private $accountNo;
    /**  string 总金额(浮动) */
    private $total;
    /**  string 系数 */
    private $ratio;

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