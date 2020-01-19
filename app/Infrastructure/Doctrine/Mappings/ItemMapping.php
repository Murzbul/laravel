<?php

namespace App\Infrastructure\Doctrine\Mappings;

use Digichange\Entities\Item;
use LaravelDoctrine\Fluent\EntityMapping;
use LaravelDoctrine\Fluent\Fluent;

class ItemMapping extends EntityMapping
{
    public function mapFor()
    {
        return Item::class;
    }

    public function map(Fluent $builder)
    {
        $builder->integer('id')->primary()->autoIncrement();
        $builder->string('name');
    }
}
