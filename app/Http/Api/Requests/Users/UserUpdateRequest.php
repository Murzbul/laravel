<?php

namespace App\Http\Api\Requests\Users;

use Digichange\Entities\User;
use Digichange\Payloads\Users\UserUpdatePayload;
use Digichange\Repositories\UserRepository;
use Illuminate\Http\Request;
use Lib\Validators\UuidValidator;

class UserUpdateRequest implements UserUpdatePayload
{
    const ID = 'blogId';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const NAME = 'name';

    /** @var Request */
    private $request;
    /** @var UserRepository */
    private $repository;
    /** @var User */
    private $user;
    /** @var UuidValidator */
    private $uuidValidator;
    /** @var string */
    private $id;

    public function __construct(Request $request, UserRepository $repository, UuidValidator $uuidValidator)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->uuidValidator = $uuidValidator;
        $this->id = $this->request->route()->parameter(self::ID);
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

    public function id(): string
    {
        return $this->id;
    }

    public function user(): User
    {
        $this->user = $this->repository->get($this->id());

        return $this->user;
    }

    public function validate()
    {
        $this->uuidValidator->validate($this->id);

        return $this->request->validate([
            static::EMAIL => 'required|email|max:30|unique: ' . User::class . ',email,' . $this->id,
            static::PASSWORD => 'required|confirmed|min:6|max:12',
            static::NAME => 'nullable|max:20',
        ]);
    }
}
