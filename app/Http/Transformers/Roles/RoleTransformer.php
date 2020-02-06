<?php

namespace App\Http\Transformers\Roles;

use App\Http\Transformers\Defaults\TimestampableTransformer;
use Digichange\Entities\Role;
use Flugg\Responder\Transformers\Transformer;

class RoleTransformer extends Transformer
{
    protected $load = [
        'dateTime' => TimestampableTransformer::class,
    ];

    public function transform(Role $role)
    {
        return array_convert_nulls_to_empty([
            'id' => $role->getId(),
            'name' => $role->getName(),
            'slug' => $role->getSlug(),
        ]);
    }

    public function includeDateTime(Role $role)
    {
        return $role;
    }
}
