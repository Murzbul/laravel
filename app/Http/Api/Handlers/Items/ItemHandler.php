<?php

namespace App\Http\Api\Handlers\Items;

use App\Http\Api\Handlers\Handler;
use App\Http\Api\Requests\Items\ItemCreateRequest;
use App\Http\Api\Requests\Items\ItemListRequest;
use App\Http\Api\Requests\Items\ItemShowRequest;
use App\Http\Api\Requests\Items\ItemUpdateRequest;
use App\Http\Responders\MetadataResponder as Responder;
use App\Http\Transformers\Items\ItemTransformer;
use Digichange\Services\Items\ItemService;

class ItemHandler extends Handler
{
    /** @var Responder */
    private $responder;
    /** @var ItemService */
    private $service;

    public function __construct(ItemService $service, Responder $responder)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function create(ItemCreateRequest $request)
    {
        $request->validate();

        $item = $this->service->create($request);

        return $this->responder->success($item, new ItemTransformer())->respond();
    }

    public function list(ItemListRequest $request)
    {
        $request->validate();

        // TODO: Add pagination logic and data
        $items = $this->service->list($request);

        return $this->responder->success($items, new ItemTransformer())->respond();
    }

    public function update(ItemUpdateRequest $request)
    {
        $request->validate();

        $item = $this->service->update($request);

        return $this->responder->success($item, new ItemTransformer())->respond();
    }

    public function show(ItemShowRequest $request)
    {
        $request->validate();

        $item = $this->service->show($request);

        return $this->responder->success($item, new ItemTransformer())->respond();
    }
}
