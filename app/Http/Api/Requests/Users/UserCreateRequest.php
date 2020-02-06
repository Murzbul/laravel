<?php

namespace App\Http\Api\Requests\Users;

use Digichange\Entities\User;
use Digichange\Payloads\Users\UserCreatePayload;
use Illuminate\Http\Request;

class UserCreateRequest implements UserCreatePayload
{
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const NAME = 'name';

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
        return bcrypt($this->request->get(self::PASSWORD));
    }

    public function name(): string
    {
        return $this->request->get(self::NAME);
    }

    public function validate()
    {
        return $this->request->validate([
            static::EMAIL => 'required|email|max:30|unique: ' . User::class . ',email,',
            static::PASSWORD => 'required|confirmed|min:6|max:12',
            static::NAME => 'nullable|max:20',
        ]);
    }
}
