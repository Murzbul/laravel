<?php

namespace App\Infrastructure\Doctrine\Criteria\Roles;

use Lib\Criteria\Contracts\Filter;
use Lib\Criteria\Traits\FilterTrait;

class RoleFilter implements Filter
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
            'slug',
        ];
    }
}
