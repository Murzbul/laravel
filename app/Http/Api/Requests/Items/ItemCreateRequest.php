<?php

namespace App\Http\Api\Requests\Items;

use Digichange\Payloads\Items\ItemCreatePayload;
use Illuminate\Http\Request;

class ItemCreateRequest implements ItemCreatePayload
{
    const NAME = 'name';

    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function name(): string
    {
        return $this->request->get(self::NAME);
    }

    public function validate()
    {
        return $this->request->validate([
            static::NAME => 'required|max:20',
        ]);
    }
}
