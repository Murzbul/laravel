<?php

namespace App\Http\Transformers\Items;

use Digichange\Entities\Item;
use Flugg\Responder\Transformers\Transformer;

class ItemTransformer extends Transformer
{
    public function transform(Item $client)
    {
        return array_convert_nulls_to_empty([
            'id' => $client->getId(),
            'name' => $client->getName(),
        ]);
    }
}
