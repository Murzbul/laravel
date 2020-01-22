<?php

namespace Digichange\Payloads\Items;

interface ItemUpdatePayload extends ItemPayload
{
    public function id(): int;

    public function name(): string;
}
