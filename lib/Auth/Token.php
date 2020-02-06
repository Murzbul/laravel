<?php

namespace Lib\Auth;

use Lib\Auth\Contracts\IToken;
use Tymon\JWTAuth\Token as Base;

class Token extends Base implements IToken
{
    const TOKEN_TYPE = 'Bearer';

    /** @var int */
    private $ttl;

    public function __construct(string $value, int $ttl)
    {
        parent::__construct($value);
        $this->ttl = $ttl;
    }

    public function getTTL(): int
    {
        return $this->ttl;
    }
}
