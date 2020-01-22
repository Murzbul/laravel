<?php

namespace App\Infrastructure\Doctrine\Criteria\Items;

use Lib\Criteria\Contracts\Sorting;
use Lib\Criteria\Traits\SortingTrait;

class ItemSorting implements Sorting
{
    use SortingTrait;

    public const NAME = 'name';

    protected $sortingKey = [
        self::NAME,
    ];
}
