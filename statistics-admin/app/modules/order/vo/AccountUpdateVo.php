<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/18
 */

namespace app\modules\order\vo;

use app\modules\order\validate\AccountValidator;
use framework\vo\RequestVoInterface;

class AccountUpdateVo extends BaseVo
{
    /** string 关联的用户id */
    private $id;
    /** string 总金额(浮动) */
    private $total;
    /** string 系数 */
    private $ratio;

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



    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [AccountValidator::class, 'update'];
    }
}