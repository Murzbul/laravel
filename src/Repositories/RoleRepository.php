<?php

namespace Digichange\Repositories;

use Digichange\Entities\Role;
use Lib\Criteria\Contracts\Criteria;

interface RoleRepository extends ReadRepository
{
    const CLASS_NAME = Role::class;

    public function search(Criteria $criteria);
}
