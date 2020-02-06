<?php

namespace App\Http\Transformers\Defaults;

use Flugg\Responder\Transformers\Transformer;
use Lib\Contracts\Timestampable;

class TimestampableTransformer extends Transformer
{
    public function transform(Timestampable $timestampable)
    {
        return [
            'createdAt' => $timestampable->getCreatedAt()->toIso8601String(),
            'updatedAt' => $timestampable->getUpdatedAt()->toIso8601String(),
        ];
    }
}
