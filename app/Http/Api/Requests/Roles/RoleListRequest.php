<?php

namespace App\Http\Api\Requests\Roles;

use App\Infrastructure\Doctrine\Criteria\Roles\RoleFilter;
use App\Infrastructure\Doctrine\Criteria\Roles\RoleSorting;
use Illuminate\Http\Request;
use Lib\Criteria\Criteria;

class RoleListRequest extends Criteria
{
    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $values = $request->all();
        $filter = new RoleFilter($values);
        $sorting = new RoleSorting($values);

        parent::__construct($request, $filter, $sorting);
    }

    public function getSortingDefaults(): array
    {
        return [RoleSorting::NAME => 'desc'];
    }
}
