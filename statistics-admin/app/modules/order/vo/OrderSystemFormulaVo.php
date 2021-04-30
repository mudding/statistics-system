<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\vo;

use app\exception\BizException;
use app\modules\order\validate\OrderValidate;

class OrderSystemFormulaVo extends BaseVo
{
    /** string 关联的账户Id */
    private $accountId;
    /**  string 手数/仓位 */
    private $inputHandCount;
    /**  string 入场点数 */
    private $inputPoint;
    /**  string 保证金 */
    private $deposit;
    /**  string 止损位置 */
    private $lossPoint;
    /**  string 该仓位止损金额 */
    private $lossAmount;
    /** string 额外的倍数 */
    private $otherMultiple;

    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [OrderValidate::class, 'getSystemFormula'];
    }


    public function checkParameter()
    {
        if (empty($this->inputHandCount) && empty($this->lossPoint)) {
            throw new BizException('下单手数，止损点位不能同时为空');
        }
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return mixed
     */
    public function getInputHandCount()
    {
        return $this->inputHandCount;
    }

    /**
     * @param mixed $inputHandCount
     */
    public function setInputHandCount($inputHandCount): void
    {
        $this->inputHandCount = $inputHandCount;
    }

    /**
     * @return mixed
     */
    public function getInputPoint()
    {
        return $this->inputPoint;
    }

    /**
     * @param mixed $inputPoint
     */
    public function setInputPoint($inputPoint): void
    {
        $this->inputPoint = $inputPoint;
    }

    /**
     * @return mixed
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * @param mixed $deposit
     */
    public function setDeposit($deposit): void
    {
        $this->deposit = $deposit;
    }

    /**
     * @return mixed
     */
    public function getLossPoint()
    {
        return $this->lossPoint;
    }

    /**
     * @param mixed $lossPoint
     */
    public function setLossPoint($lossPoint): void
    {
        $this->lossPoint = $lossPoint;
    }

    /**
     * @return mixed
     */
    public function getLossAmount()
    {
        return $this->lossAmount;
    }

    /**
     * @param mixed $lossAmount
     */
    public function setLossAmount($lossAmount): void
    {
        $this->lossAmount = $lossAmount;
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


}