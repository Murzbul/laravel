<?php

namespace Digichange\Entities;

use Digichange\Payloads\Items\ItemUpdatePayload;

class Item
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
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
