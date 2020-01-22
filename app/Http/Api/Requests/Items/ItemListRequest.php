<?php

namespace App\Http\Api\Requests\Items;

use App\Infrastructure\Doctrine\Criteria\Items\ItemFilter;
use App\Infrastructure\Doctrine\Criteria\Items\ItemSorting;
use Illuminate\Http\Request;
use Lib\Criteria\Criteria;

class ItemListRequest extends Criteria
{
    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $values = $request->all();
        $itemFilter = new ItemFilter($values);
        $itemSorting = new ItemSorting($values);

        parent::__construct($request, $itemFilter, $itemSorting);
    }

    public function getSortingDefaults(): array
    {
        return [ItemSorting::NAME => 'desc'];
    }
}
