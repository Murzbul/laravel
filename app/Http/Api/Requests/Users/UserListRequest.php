<?php

namespace App\Http\Api\Requests\Users;

use App\Infrastructure\Doctrine\Criteria\Users\UserFilter;
use App\Infrastructure\Doctrine\Criteria\Users\UserSorting;
use Illuminate\Http\Request;
use Lib\Criteria\Criteria;

class UserListRequest extends Criteria
{
    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $values = $request->all();
        $filter = new UserFilter($values);
        $sorting = new UserSorting($values);

        parent::__construct($request, $filter, $sorting);
    }

    public function getSortingDefaults(): array
    {
        return [UserSorting::NAME => 'desc'];
    }
}
