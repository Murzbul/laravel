<?php

namespace Digichange\Services\Auth;

use App\Http\Api\Requests\Auth\AuthLoginRequest;
use Digichange\Payloads\Auth\AuthLoginPayload;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Lib\Auth\AuthData;
use Lib\Auth\Token;
use Tymon\JWTAuth\Factory;
use Tymon\JWTAuth\JWTGuard;

class AuthService
{
    /** @var JWTGuard */
    private $guard;
    /** @var Factory */
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->guard = Auth::guard('api');
        $this->factory = $factory;
    }

    public function login(AuthLoginPayload $payload): AuthData
    {
        $credentials = [
            AuthLoginRequest::EMAIL => $payload->email(),
            AuthLoginRequest::PASSWORD => $payload->password(),
        ];

        if (! $hashToken = $this->guard->attempt($credentials)) {
            throw new AuthenticationException();
        }

        $token = new Token($hashToken, $this->factory->getTTL());
        $authData = new AuthData($token, $this->guard->user());

        return $authData;
    }
}
