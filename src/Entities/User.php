<?php

namespace Digichange\Entities;

use Digichange\Payloads\Users\UserUpdatePayload;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lib\Contracts\Timestampable as ITimestapable;
use Lib\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User implements Authenticatable, JWTSubject, ITimestapable
{
    use Notifiable;
    use Timestampable;

    /** @var Uuid */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $password;
    /** @var string */
    private $rememberToken;
    /** @var Role[]|ArrayCollection */
    private $roles;

    public function __construct(string $name, string $email, string $password)
    {
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->roles = new ArrayCollection();
    }

    public function update(UserUpdatePayload $payload): User
    {
        $this->name = $payload->name();
        $this->email = $payload->email();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRole(Role $role): void
    {
        $this->roles->add($role);
    }

    public function getAuthIdentifierName()
    {
        return $this->email;
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
