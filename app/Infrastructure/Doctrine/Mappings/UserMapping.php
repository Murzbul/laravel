<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Digichange\Entities\Role;
use Digichange\Entities\User;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use Lib\Doctrine\Types\UuidType;

class UserMapping extends EntityMapping
{
    public function mapFor()
    {
        return User::class;
    }

    public function map(Fluent $builder)
    {
        $builder->field(UuidType::UUID, 'id')->primary();
        $builder->string('name');
        $builder->string('email')->unique();
        $builder->string('password');

        $builder
            ->belongsToMany(Role::class, 'roles')
            ->joinTable('user_has_roles')
            ->addJoinColumn(null, 'default_user_id', 'id', false, false, 'CASCADE')
            ->addInverseJoinColumn('default_role_id', 'id', false, false, 'CASCADE');

        $builder->timestamps('createdAt', 'updatedAt', 'carbonDateTime');
    }
}
