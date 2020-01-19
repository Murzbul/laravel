<?php

namespace App\Infrastructure\Doctrine\Repositories;

use Digichange\Entities\Item;
use Digichange\Repositories\ItemRepository;

class DoctrineItemRepository extends DoctrineReadRepository implements ItemRepository
{
    public function getEntity()
    {
        return Item::class;
    }
}
