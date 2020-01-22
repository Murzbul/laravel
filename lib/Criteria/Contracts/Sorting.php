<?php

namespace Lib\Criteria\Contracts;

interface Sorting
{
    public function get(array $sortFields): array;

    public function set(array $sortFields);

    public function getRaw(): array;
}
