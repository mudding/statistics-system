<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/4/27
 */

namespace app\modules\order\vo;

use app\modules\order\validate\OrderValidate;

class OrderSystemFormulaVo extends BaseVo
{

    public function valid(): array
    {
        // TODO: Implement valid() method.
        return [OrderValidate::class, 'update'];
    }
}