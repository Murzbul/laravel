<?php

namespace Lib\Auth\Contracts;

interface IToken
{
    public function getTTL(): int;
}
