<?php

namespace App\Infrastructure\Doctrine\Criteria\Users;

use Lib\Criteria\Contracts\Sorting;
use Lib\Criteria\Traits\SortingTrait;

class UserSorting implements Sorting
{
    use SortingTrait;

    public const NAME = 'name';

    protected $sortingKey = [
        self::NAME,
    ];
}
