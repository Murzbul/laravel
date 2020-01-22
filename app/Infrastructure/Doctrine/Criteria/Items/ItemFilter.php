<?php

namespace App\Infrastructure\Doctrine\Criteria\Items;

use Lib\Criteria\Contracts\Filter;
use Lib\Criteria\Traits\FilterTrait;

class ItemFilter implements Filter
{
    use FilterTrait;

    const SEARCH = 'search';

    protected $filters = [
        self::SEARCH,
    ];

    public function getFields(): array
    {
        return [
            'name',
        ];
    }
}
