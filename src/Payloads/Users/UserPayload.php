<?php

namespace Digichange\Payloads\Users;

use Digichange\Entities\User;

interface UserPayload
{
    public function user(): ?User;
}
