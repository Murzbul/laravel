<?php

namespace App\Http\Api\Requests\Roles;

use Digichange\Entities\Role;
use Digichange\Payloads\Roles\RoleUpdatePayload;
use Digichange\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Lib\Validators\UuidValidator;

class RoleUpdateRequest implements RoleUpdatePayload
{
    const ID = 'blogId';
    const NAME = 'name';
    const SLUG = 'slug';

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

    public function name(): string
    {
        return $this->request->get(self::NAME);
    }

    public function slug(): string
    {
        return $this->request->get(self::SLUG);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function role(): Role
    {
        $this->role = $this->repository->get($this->id());

        return $this->role;
    }

    public function validate()
    {
        $this->uuidValidator->validate($this->id);

        return $this->request->validate([
            static::SLUG => 'required|max:30' . Role::class . ',slug,' . $this->id,
            static::NAME => 'required|max:30',
        ]);
    }
}
