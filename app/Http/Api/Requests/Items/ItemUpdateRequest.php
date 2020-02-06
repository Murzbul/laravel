<?php

namespace App\Http\Api\Requests\Items;

use Digichange\Entities\Item;
use Digichange\Payloads\Items\ItemUpdatePayload;
use Digichange\Repositories\ItemRepository;
use Illuminate\Http\Request;

class ItemUpdateRequest implements ItemUpdatePayload
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

    public function name(): string
    {
        return $this->request->get(self::NAME);
    }

    public function id(): string
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
        return $this->request->validate([
            static::NAME => 'required|max:20',
        ]);
    }
}
