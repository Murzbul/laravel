<?php

namespace App\Http\Api\Handlers\Items;

use App\Http\Api\Handlers\Handler;
use App\Http\Api\Requests\Items\ItemCreateRequest;
use App\Http\Responders\MetadataResponder as Responder;
use App\Http\Transformers\Items\ItemTransformer;
use Digichange\Services\Items\ItemService;

class CreateItemHandler extends Handler
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

    public function handler(ItemCreateRequest $request)
    {
        $request->validate();

        $item = $this->service->create($request);

        return $this->responder->success($item, new ItemTransformer())->respond();
    }
}
