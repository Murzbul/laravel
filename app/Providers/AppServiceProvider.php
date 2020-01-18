<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $classBindings = [];

        /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->classBindings as $abstract => $concrete) {
            if (is_array($concrete)) {
                $concrete = $concrete[$this->app->environment()] ?? $concrete['default'];
            }

            $this->app->bind($abstract, $concrete);
        }

        if (config('app.debug')) {
            $this->app->register(\Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class);
            $this->app->register(\PrettyRoutes\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    private function configureMonologSentryHandler()
    {
        if (config('sentry.enabled') && config('sentry.logging.enabled')) {
            $this->app->register(\Sentry\Laravel\ServiceProvider::class);
        }
    }
}
