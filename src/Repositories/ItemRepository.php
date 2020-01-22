<?php

namespace Digichange\Repositories;

use Digichange\Entities\Item;
use Lib\Criteria\Contracts\Criteria;

interface ItemRepository extends ReadRepository
{
    const CLASS_NAME = Item::class;

    public function search(Criteria $criteria);
}
