<?php

namespace Digichange\Payloads\Users;

interface UserShowPayload extends UserPayload
{
    public function id(): string;
}
