<?php

namespace Digichange\Services\Items;

use Digichange\Entities\Item;
use Digichange\Payloads\Items\ItemCreatePayload;
use Digichange\Payloads\Items\ItemShowPayload;
use Digichange\Payloads\Items\ItemUpdatePayload;
use Digichange\Repositories\ItemRepository;
use Digichange\Repositories\PersistRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Lib\Criteria\Contracts\Criteria;

class ItemService
{
    /** @var PersistRepository */
    private $repository;
    /** @var ItemRepository */
    private $itemRepository;

    public function __construct(PersistRepository $repository, ItemRepository $itemRepository)
    {
        $this->repository = $repository;
        $this->itemRepository = $itemRepository;
    }

    public function create(ItemCreatePayload $payload): Item
    {
        $name = $payload->name();

        $item = new Item($name);

        $this->repository->save($item);

        return $item;
    }

    public function update(ItemUpdatePayload $payload): Item
    {
        $item = $payload->item();

        $item->update($payload);

        $this->repository->save($item);

        return $item;
    }

    public function list(Criteria $criteria): Paginator
    {
        $items = $this->itemRepository->search($criteria);

        return $items;
    }

    public function show(ItemShowPayload $payload): Item
    {
        $item = $payload->item();

        return $item;
    }
}
