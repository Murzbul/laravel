<?php

namespace Lib\Auth\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface IAuth
{
    public function token(): string;

    public function ttl(): int;

    public function user(): Authenticatable;

    public function tokenType(): string;
}
