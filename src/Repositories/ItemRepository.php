<?php

namespace Digichange\Repositories;

use Digichange\Entities\Item;

interface ItemRepository extends ReadRepository
{
    const CLASS_NAME = Item::class;
}
