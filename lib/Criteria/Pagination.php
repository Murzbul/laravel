<?php

namespace Lib\Criteria;

use Lib\Criteria\Contracts\Pagination as IPagination;

class Pagination implements IPagination
{
    /** @var int|null */
    private $page;
    /** @var int */
    private $limit;

    public function __construct(int $limit = null, int $page = 1)
    {
        $this->limit = $limit;
        $this->page = $page;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->getLimit() * ($this->getPage() - 1);
    }

    /**
     * Set the page according to current limit.
     *
     * @param int $offset
     */
    public function setPageFromOffset(int $offset)
    {
        $this->page = floor($offset / $this->limit) + 1;
    }

    public function clone(int $limit = null, int $page = 1)
    {
        return new static($limit, $page);
    }
}
