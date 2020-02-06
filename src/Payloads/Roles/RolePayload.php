<?php

namespace Digichange\Payloads\Roles;

use Digichange\Entities\Role;

interface RolePayload
{
    public function role(): ?Role;
}
