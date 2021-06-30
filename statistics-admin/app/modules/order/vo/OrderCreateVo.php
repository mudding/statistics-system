<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\vo;

use app\exception\BizException;
use app\modules\order\validate\OrderValidate;

class OrderCreateVo extends BaseVo
{
    /* 程序赋值 */
    /** 关联的账户类型(程序赋值) */
    private $accountType;
    /** 订单Id(程序赋值)  */
    private $id;
    /** 订单号(程序赋值)  */
    private $no;
    /** 单笔最大亏损额度(程序赋值) */
    private $maxLossAmount;
    /** 总余额(程序赋值)  */
    private $total;
    /** 可用余额(程序赋值)  */
    private $balance;
    /** 冻结资金(程序赋值)  */
    private $frozen;


    /* 传参 */
    /** string 关联的账户Id */
    private $accountId;

    /** string 订单类型，1=发起单，2=节点单，3=加仓单,4=游击战 */
    private $orderType;


    /** 订单类型 == 加仓单时，关联订单Id  */
    private $orderPid;


    /** string 订单状态,1=持单中,2=平仓一部分,3=该条数据全部平仓，4=计划中，5=计划失败 */
    /** 是否计划单，1-是，0-否 */
    private $isPlan;
    /** string 交易品种Id */
    private $varietyId;
    /** string 入场信号周期id */
    private $inputSignalTimeId;
    /** string 手数/仓位 */
    private $inputHandCount;
    /** string 入场点数 */
    private $inputPoint;
    /** string 保证金 */
    private $deposit;
    /** string 止损位置 */
    private $lossPoint;
    /** string 该仓位止损金额 */
    private $lossAmount;
    /** string 入场理由  */
    private $inputReason;
    /** string 入场图片 */
    private $inputImages;
    /** int 订单方向，1-多，0-空 */
    private $direction;


    /**
     * @return array|string[]
     */
    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [OrderValidate::class, 'create'];
    }

    public function checkOrderAddParameter()
    {
        if (empty($this->getOrderPid())) {
            throw new BizException('加仓单，关联订单id不能为空！');
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
    public function getOrderPid()
    {
        return $this->orderPid;
    }

    /**
     * @param mixed $orderPid
     */
    public function setOrderPid($orderPid): void
    {
        $this->orderPid = $orderPid;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * @param mixed $no
     */
    public function setNo($no): void
    {
        $this->no = $no;
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->accountType;
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
    public function getMaxLossAmount()
    {
        return $this->maxLossAmount;
    }

    /**
     * @param mixed $maxLossAmount
     */
    public function setMaxLossAmount($maxLossAmount): void
    {
        $this->maxLossAmount = $maxLossAmount;
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

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction): void
    {
        $this->direction = $direction;
    }


    /**
     * @return mixed
     */
    public function getIsPlan()
    {
        return $this->isPlan;
    }

    /**
     * @param mixed $isPlan
     */
    public function setIsPlan($isPlan): void
    {
        $this->isPlan = $isPlan;
    }

}