<?php

namespace Digichange\Entities;

use Digichange\Payloads\Items\ItemUpdatePayload;
use Ramsey\Uuid\Uuid;

class Item
{
    /** @var Uuid */
    private $id;
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function update(ItemUpdatePayload $payload)
    {
        $this->name = $payload->name();
    }
}
