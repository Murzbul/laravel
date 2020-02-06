<?php

namespace App\Http\Api\Requests\Roles;

use Digichange\Payloads\Roles\RoleCreatePayload;
use Illuminate\Http\Request;

class RoleCreateRequest implements RoleCreatePayload
{
    const NAME = 'name';
    const SLUG = 'slug';

    /** @var Request */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function name(): string
    {
        return $this->request->get(self::NAME);
    }

    public function slug(): string
    {
        return $this->request->get(self::SLUG);
    }

    public function validate()
    {
        return $this->request->validate([
            static::NAME => 'required|max:30',
            static::SLUG => 'required|max:30',
        ]);
    }
}
