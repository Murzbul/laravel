<?php

namespace App\Infrastructure\Doctrine\Criteria\Roles;

use Lib\Criteria\Contracts\Sorting;
use Lib\Criteria\Traits\SortingTrait;

class RoleSorting implements Sorting
{
    use SortingTrait;

    public const NAME = 'name';

    protected $sortingKey = [
        self::NAME,
    ];
}
