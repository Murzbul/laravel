<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class RouteServiceProvider extends ServiceProvider
{
    const WEB_ROUTE_PREFIX = '/';
    const API_ROUTE_PREFIX = '/api';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Api\Handlers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $handlers = Finder::create()->files()->in(app_path('Http/*/Handlers'));

        /** @var SplFileInfo $file */
        foreach ($handlers as $file) {
            $route = $this->namespace . '\\' . $file->getRelativePath();

            Route::middleware('web')
                ->prefix(static::WEB_ROUTE_PREFIX)
                ->namespace($route)
                ->group(base_path('routes/web.php'));
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $handlers = Finder::create()->files()->in(app_path('Http/*/Handlers'));

        /** @var SplFileInfo $file */
        foreach ($handlers as $file) {
            $route = $this->namespace . '\\' . $file->getRelativePath();

            Route::middleware('api')
                ->prefix(static::API_ROUTE_PREFIX)
                ->namespace($route)
                ->group(base_path('routes/api.php'));
        }
    }
}
