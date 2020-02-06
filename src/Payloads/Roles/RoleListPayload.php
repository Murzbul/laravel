<?php

namespace Digichange\Payloads\Roles;

interface RoleListPayload
{
    public function name(): string;

    public function slug(): string;
}
