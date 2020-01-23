<?php

namespace Lib\Criteria\Contracts;

interface Pagination
{
    public function getPage(): int;

    public function getLimit(): int;

    public function getOffset(): int;

    public function setPageFromOffset(int $offset);

    public function clone(int $limit = null, int $page = 1);
}
