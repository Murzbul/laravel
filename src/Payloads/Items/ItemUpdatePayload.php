<?php

namespace Digichange\Payloads\Items;

interface ItemUpdatePayload extends ItemPayload
{
    public function id(): string;

    public function name(): string;
}
