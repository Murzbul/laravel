<?php

namespace Digichange\Entities;

use Digichange\Payloads\Roles\RoleUpdatePayload;
use Lib\Contracts\Timestampable as ITimestapable;
use Lib\Traits\Timestampable;
use Ramsey\Uuid\Uuid;

class Role implements ITimestapable
{
    use Timestampable;

    /** @var Uuid */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $slug;

    public function __construct(string $name, string $slug)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->slug = $slug;
    }

    public function update(RoleUpdatePayload $payload): Role
    {
        $this->name = $payload->name();
        $this->slug = $payload->slug();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
