<?php

namespace App\Http\Api\Requests\Roles;

use Digichange\Entities\Role;
use Digichange\Payloads\Roles\RoleShowPayload;
use Digichange\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Lib\Validators\UuidValidator;

class RoleShowRequest implements RoleShowPayload
{
    const ID = 'blogId';

    /** @var Request */
    private $request;
    /** @var RoleRepository */
    private $repository;
    /** @var Role */
    private $role;
    /** @var UuidValidator */
    private $uuidValidator;
    /** @var string */
    private $id;

    public function __construct(Request $request, RoleRepository $repository, UuidValidator $uuidValidator)
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

    public function role(): Role
    {
        $this->role = $this->repository->get($this->id());

        return $this->role;
    }

    public function validate()
    {
        $this->uuidValidator->validate($this->id);

        return $this->request->validate([]);
    }
}
