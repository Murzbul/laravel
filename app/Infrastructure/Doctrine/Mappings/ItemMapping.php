<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Digichange\Entities\Item;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;
use Lib\Doctrine\Types\UuidType;

class ItemMapping extends EntityMapping
{
    public function mapFor()
    {
        return Item::class;
    }

    public function map(Fluent $builder)
    {
        $builder->field(UuidType::UUID, 'id')->primary();
        $builder->string('name');
    }
}
