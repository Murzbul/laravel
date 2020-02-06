<?php

namespace App\Providers;

use Digichange\Entities\Role;
use Digichange\Entities\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('isAdmin', function ($user) {
            /* @var User $user */
            return $user->getRoles()->filter(function ($role) {
                /* @var Role $role */
                return $role->getSlug() === 'admin';
            })->first();
        });

        Auth::extend('jwt', function ($app, $name, array $config) {
            return new JwtGuard($app->make(JWT::class), Auth::createUserProvider($config['provider']), $app->make(Request::class));
        });
    }
}
