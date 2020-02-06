<?php

namespace App\Http\Transformers\Auths;

use App\Http\Transformers\Defaults\TimestampableTransformer;
use Digichange\Entities\User;
use Flugg\Responder\Transformers\Transformer;

class UserTransformer extends Transformer
{
    protected $load = [
        'dateTime' => TimestampableTransformer::class,
    ];

    public function transform(User $user)
    {
        return array_convert_nulls_to_empty([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ]);
    }

    public function includeDateTime(User $user)
    {
        return $user;
    }
}
