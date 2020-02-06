<?php

namespace Digichange\Payloads\Roles;

interface RoleUpdatePayload extends RolePayload
{
    public function id(): string;

    public function name(): string;

    public function slug(): string;
}
