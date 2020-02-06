<?php

namespace Digichange\Payloads\Items;

interface ItemShowPayload extends ItemPayload
{
    public function id(): string;
}
