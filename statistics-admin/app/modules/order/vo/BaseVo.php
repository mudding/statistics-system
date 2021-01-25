<?php

/**
 * @author: mofh <mofh@pvc123.com>
 * @data  : 2021/1/25
 */

namespace app\modules\order\vo;


use framework\vo\RequestVoInterface;

abstract class BaseVo implements RequestVoInterface
{
    protected $page = 1;

    protected $pageSize = 10;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page): void
    {
        if (is_numeric($page)) {
            $this->page = $page;
        }
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize): void
    {
        if (is_numeric($pageSize)) {
            $this->pageSize = $pageSize;
        }
    }

}