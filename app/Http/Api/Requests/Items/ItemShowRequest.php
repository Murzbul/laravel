<?php

namespace App\Http\Api\Requests\Items;

use Digichange\Entities\Item;
use Digichange\Payloads\Items\ItemShowPayload;
use Digichange\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemShowRequest implements ItemShowPayload
{
    const ID = 'itemId';
    const NAME = 'name';

    /** @var Request */
    private $request;
    /** @var ItemRepository */
    private $repository;
    /** @var Item */
    private $item;

    public function __construct(Request $request, ItemRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function id(): int
    {
        return $this->request->route()->parameter(self::ID);
    }

    public function item(): Item
    {
        $this->item = $this->repository->get($this->id());

        return $this->item;
    }

    public function validate()
    {
        return $this->request->validate([]);
    }
}
