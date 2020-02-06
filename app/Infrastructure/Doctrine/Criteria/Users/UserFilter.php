<?php

namespace App\Infrastructure\Doctrine\Criteria\Users;

use Lib\Criteria\Contracts\Filter;
use Lib\Criteria\Traits\FilterTrait;

class UserFilter implements Filter
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
            'email',
        ];
    }
}
