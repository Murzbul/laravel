<?php

namespace Digichange\Services\Items;

use Digichange\Entities\Item;
use Digichange\Payloads\Items\ItemCreatePayload;
use Digichange\Repositories\PersistRepository;

class ItemService
{
    /** @var PersistRepository */
    private $repository;

    public function __construct(PersistRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(ItemCreatePayload $payload): Item
    {
        $name = $payload->name();

        $item = new Item($name);

        $this->repository->save($item);

        return $item;
    }
}
