<?php

namespace App\Http\Api\Handlers;

use App\Http\Api\Requests\Auth\AuthLoginRequest;
use App\Http\Api\Requests\Users\UserCreateRequest;
use App\Http\Responders\MetadataResponder as Responder;
use App\Http\Transformers\Auths\AuthLoginTransformer;
use App\Http\Transformers\Auths\UserTransformer;
use Digichange\Services\Auth\AuthService;
use Digichange\Services\Roles\RoleService;
use Digichange\Services\Users\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Lib\Auth\AuthData;
use Lib\Security\Roles;
use Tymon\JWTAuth\JWTGuard;

class AuthHandler extends Handler
{
    /** @var AuthService */
    private $service;
    /** @var Responder */
    private $responder;
    /** @var JWTGuard */
    private $guard;
    /** @var UserService */
    private $userService;
    /** @var RoleService */
    private $roleService;

    public function __construct(AuthService $service, UserService $userService, RoleService $roleService, Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
        $this->userService = $userService;
        $this->guard = Auth::guard('api');
        $this->roleService = $roleService;
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        /** @var AuthData $authData */
        $authData = $this->service->login($request);

        return $this->responder->success($authData, new AuthLoginTransformer())->respond();
    }

    public function me(): JsonResponse
    {
        $user = $this->guard->user();

        return $this->responder->success($user, new UserTransformer())->respond();
    }

    public function logout(): JsonResponse
    {
        $this->guard->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function signUp(UserCreateRequest $request): JsonResponse
    {
        $user = $this->userService->create($request);

        $this->roleService->assignRoleToUser($user, Roles::EDITOR);

        return $this->responder->success($user, new UserTransformer())->respond();
    }
}
