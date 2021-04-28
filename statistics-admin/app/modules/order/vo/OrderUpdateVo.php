<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\vo;

use app\modules\order\validate\OrderValidate;

class OrderUpdateVo extends BaseVo
{
    private $orderId;
    /** var string 关联的账户Id */
    private $accountId;
    /** var string 订单类型，1=发起单，2=节点单，3=加仓单 */
    private $orderType;
    /** var string 订单状态,1=持单中,2=平仓一部分,3=该条数据全部平仓，4=计划中，5=计划失败 */
    private $orderStatus;
    /** var string 交易品种Id */
    private $varietyId;
    /** var string 入场信号周期id */
    private $inputSignalTimeId;
    /** var string 手数/仓位 */
    private $inputHandCount;
    /** var string 入场点数 */
    private $inputPoint;
    /** var string 保证金 */
    private $deposit;
    /** var string 止损位置 */
    private $lossPoint;
    /** var string 该仓位止损金额 */
    private $lossAmount;
    /** var string 入场理由  */
    private $inputReason;
    /** var string 入场图片 */
    private $inputImages;
    /** var string 单条平仓手数 */
    private $outputHandCount;
    /** var string 出场点 */
    private $outputPoint;
    /** var string 单条平仓所得金额 */
    private $outputAmount;
    /** var string 出场理由 */
    private $outputReason;
    /** var string 出场图片 */
    private $outputImages;


    /**
     * @return array|string[]
     */
    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [OrderValidate::class, 'update'];
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
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
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param mixed $orderType
     */
    public function setOrderType($orderType): void
    {
        $this->orderType = $orderType;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param mixed $orderStatus
     */
    public function setOrderStatus($orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return mixed
     */
    public function getVarietyId()
    {
        return $this->varietyId;
    }

    /**
     * @param mixed $varietyId
     */
    public function setVarietyId($varietyId): void
    {
        $this->varietyId = $varietyId;
    }

    /**
     * @return mixed
     */
    public function getInputSignalTimeId()
    {
        return $this->inputSignalTimeId;
    }

    /**
     * @param mixed $inputSignalTimeId
     */
    public function setInputSignalTimeId($inputSignalTimeId): void
    {
        $this->inputSignalTimeId = $inputSignalTimeId;
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
    public function getInputReason()
    {
        return $this->inputReason;
    }

    /**
     * @param mixed $inputReason
     */
    public function setInputReason($inputReason): void
    {
        $this->inputReason = $inputReason;
    }

    /**
     * @return mixed
     */
    public function getInputImages()
    {
        return $this->inputImages;
    }

    /**
     * @param mixed $inputImages
     */
    public function setInputImages($inputImages): void
    {
        $this->inputImages = $inputImages;
    }

    /**
     * @return mixed
     */
    public function getOutputHandCount()
    {
        return $this->outputHandCount;
    }

    /**
     * @param mixed $outputHandCount
     */
    public function setOutputHandCount($outputHandCount): void
    {
        $this->outputHandCount = $outputHandCount;
    }

    /**
     * @return mixed
     */
    public function getOutputPoint()
    {
        return $this->outputPoint;
    }

    /**
     * @param mixed $outputPoint
     */
    public function setOutputPoint($outputPoint): void
    {
        $this->outputPoint = $outputPoint;
    }

    /**
     * @return mixed
     */
    public function getOutputAmount()
    {
        return $this->outputAmount;
    }

    /**
     * @param mixed $outputAmount
     */
    public function setOutputAmount($outputAmount): void
    {
        $this->outputAmount = $outputAmount;
    }

    /**
     * @return mixed
     */
    public function getOutputReason()
    {
        return $this->outputReason;
    }

    /**
     * @param mixed $outputReason
     */
    public function setOutputReason($outputReason): void
    {
        $this->outputReason = $outputReason;
    }

    /**
     * @return mixed
     */
    public function getOutputImages()
    {
        return $this->outputImages;
    }

    /**
     * @param mixed $outputImages
     */
    public function setOutputImages($outputImages): void
    {
        $this->outputImages = $outputImages;
    }


}