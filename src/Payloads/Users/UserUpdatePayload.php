<?php

namespace Digichange\Payloads\Users;

interface UserUpdatePayload extends UserPayload
{
    public function id(): string;

    public function email(): string;

    public function name(): string;
}
