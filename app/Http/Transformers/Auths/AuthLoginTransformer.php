<?php

namespace App\Http\Transformers\Auths;

use App\Http\Transformers\Defaults\TimestampableTransformer;
use Digichange\Entities\User;
use Flugg\Responder\Transformers\Transformer;
use Lib\Auth\AuthData;

class AuthLoginTransformer extends Transformer
{
    protected $load = [
        'dateTime' => TimestampableTransformer::class,
    ];

    public function transform(AuthData $authData)
    {
        /** @var User $user */
        $user = $authData->user();

        return array_convert_nulls_to_empty([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'token' => $authData->token(),
            'tokenType' => $authData->tokenType(),
            'expires_in' => $authData->ttl(),
        ]);
    }

    public function includeDateTime(AuthData $authData)
    {
        /** @var User $user */
        $user = $authData->user();

        return $user;
    }
}
