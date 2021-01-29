<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\vo;

class VarietyVo extends BaseVo
{
    /** @var string 账户类型 */
    private $accountType;
    /** @var string 品种名称 */
    private $varietyName;

    public function valid(): array
    {
        // TODO: Implement valid() method.
    }
}