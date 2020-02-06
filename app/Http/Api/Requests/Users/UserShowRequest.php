<?php

namespace App\Http\Api\Requests\Users;

use Digichange\Entities\User;
use Digichange\Payloads\Users\UserShowPayload;
use Digichange\Repositories\UserRepository;
use Illuminate\Http\Request;
use Lib\Validators\UuidValidator;

class UserShowRequest implements UserShowPayload
{
    const ID = 'userId';

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

    public function id(): string
    {
        return $this->request->route()->parameter(self::ID);
    }

    public function user(): User
    {
        $this->user = $this->repository->get($this->id());

        return $this->user;
    }

    public function validate()
    {
        $this->uuidValidator->validate($this->id);

        return $this->request->validate([]);
    }
}
