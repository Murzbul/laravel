<?php

namespace App\Http\Api\Handlers;

use App\Http\Api\Requests\Roles\RoleCreateRequest;
use App\Http\Api\Requests\Roles\RoleListRequest;
use App\Http\Api\Requests\Roles\RoleShowRequest;
use App\Http\Api\Requests\Roles\RoleUpdateRequest;
use App\Http\Responders\MetadataResponder as Responder;
use App\Http\Transformers\Roles\RoleTransformer;
use Digichange\Services\Roles\RoleService;

class RoleHandler extends Handler
{
    /** @var Responder */
    private $responder;
    /** @var RoleService */
    private $service;

    public function __construct(RoleService $service, Responder $responder)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function create(RoleCreateRequest $request)
    {
        $request->validate();

        $blog = $this->service->create($request);

        return $this->responder->success($blog, new RoleTransformer())->respond();
    }

    public function list(RoleListRequest $request)
    {
        $request->validate();

        $blogs = $this->service->list($request);

        return $this->responder->success($blogs, new RoleTransformer())->paginator(adapt_paginator($blogs, $request));
    }

    public function update(RoleUpdateRequest $request)
    {
        $request->validate();

        $blog = $this->service->update($request);

        return $this->responder->success($blog, new RoleTransformer())->respond();
    }

    public function show(RoleShowRequest $request)
    {
        $request->validate();

        $blog = $this->service->show($request);

        return $this->responder->success($blog, new RoleTransformer())->respond();
    }
}
