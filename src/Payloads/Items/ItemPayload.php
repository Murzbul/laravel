<?php

namespace Digichange\Payloads\Items;

use Digichange\Entities\Item;

interface ItemPayload
{
    public function item(): ?Item;
}
