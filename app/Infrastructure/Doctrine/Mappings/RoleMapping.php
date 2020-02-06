<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Digichange\Entities\Role;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use Lib\Doctrine\Types\UuidType;

class RoleMapping extends EntityMapping
{
    public function mapFor()
    {
        return Role::class;
    }

    public function map(Fluent $builder)
    {
        $builder->field(UuidType::UUID, 'id')->primary();
        $builder->string('name');
        $builder->string('slug')->unique();

        $builder->timestamps('createdAt', 'updatedAt', 'carbonDateTime');
    }
}
