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
    /**  string 入场位置 */
    private $inputPoint;
    /**  string 保证金 */
    private $deposit;
    /**  string 止损位置 */
    private $lossPoint;
    /**  string 该仓位止损金额 */
    private $lossAmount;
    /** string 额外的倍数(合约数量，用于计算) */
    private $otherMultiple;
    /** @var $maxLossAmount float 单笔最大亏损金额(程序赋值) */
    private $maxLossAmount;
    /** @var $balance float 可用余额(程序赋值) */
    private $balance;

    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [OrderValidate::class, 'getSystemFormula'];
    }

    public function checkNotEmpty()
    {
        if (empty($this->inputHandCount) && empty($this->lossPoint)) {
            throw new BizException('下单手数，止损位置不能同时为空');
        }
    }

    public function checkLossAmount()
    {
        // 止损金额为空时，设置为单笔最大止损金额
        if (empty($this->getLossAmount())) {
            $this->setLossAmount($this->getMaxLossAmount());
        } else {
            if ($this->getMaxLossAmount() < $this->getLossAmount()) {
                throw new BizException('仓位亏损金额不能大于单笔最大亏损金额！');
            }
        }
    }

    public function checkDeposit()
    {
        if (empty($this->getDeposit())) {
            throw new BizException('保证金不能为空');
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

    /**
     * @return float
     */
    public function getMaxLossAmount(): float
    {
        return $this->maxLossAmount;
    }

    /**
     * @param float $maxLossAmount
     */
    public function setMaxLossAmount(float $maxLossAmount): void
    {
        $this->maxLossAmount = $maxLossAmount;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }


}