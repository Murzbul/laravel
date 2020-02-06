<?php

namespace App\Http\Api\Requests\Auth;

use Digichange\Payloads\Auth\AuthLoginPayload;
use Illuminate\Http\Request;

class AuthLoginRequest implements AuthLoginPayload
{
    const EMAIL = 'email';
    const PASSWORD = 'password';

    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function email(): string
    {
        return $this->request->get(self::EMAIL);
    }

    public function password(): string
    {
        return $this->request->get(self::PASSWORD);
    }

    public function validate()
    {
        return $this->request->validate([
            static::EMAIL => 'required|email|max:30',
            static::PASSWORD => 'required|min:6|max:12',
        ]);
    }
}
