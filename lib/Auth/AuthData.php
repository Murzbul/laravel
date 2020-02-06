<?php

namespace Lib\Auth;

use Digichange\Entities\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Lib\Auth\Contracts\IAuth;
use Lib\Auth\Contracts\IToken;

class AuthData implements IAuth
{
    /** @var Token */
    private $token;
    /** @var Authenticatable */
    private $user;

    public function __construct(IToken $token, Authenticatable $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function token(): string
    {
        return $this->token->get();
    }

    public function ttl(): int
    {
        return $this->token->getTTL() * 60;
    }

    public function user(): Authenticatable
    {
        return $this->user;
    }

    public function tokenType(): string
    {
        return Token::TOKEN_TYPE;
    }
}
