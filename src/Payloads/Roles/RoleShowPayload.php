<?php

namespace Digichange\Payloads\Roles;

interface RoleShowPayload extends RolePayload
{
    public function id(): string;
}
