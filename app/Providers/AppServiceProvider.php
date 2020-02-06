<?php

namespace App\Providers;

use App\Infrastructure\Doctrine\Repositories\DoctrineItemRepository;
use App\Infrastructure\Doctrine\Repositories\DoctrinePersistRepository;
use App\Infrastructure\Doctrine\Repositories\DoctrineReadRepository;
use App\Infrastructure\Doctrine\Repositories\DoctrineRoleRepository;
use App\Infrastructure\Doctrine\Repositories\DoctrineUserRepository;
use Digichange\Repositories\ItemRepository;
use Digichange\Repositories\PersistRepository;
use Digichange\Repositories\ReadRepository;
use Digichange\Repositories\RoleRepository;
use Digichange\Repositories\UserRepository;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\ServiceProvider;
use Lib\Criteria\Contracts\Criteria;
use Lib\Criteria\Contracts\Criteria as ICriteria;
use Lib\Doctrine\Types\UuidType;

class AppServiceProvider extends ServiceProvider
{
    private $classBindings = [
        // Criteria
        ICriteria::class => Criteria::class,

        // Generic Repositories
        PersistRepository::class => DoctrinePersistRepository::class,

        // Read Repositories
        ItemRepository::class => DoctrineItemRepository::class,
        ReadRepository::class => DoctrineReadRepository::class,
        UserRepository::class => DoctrineUserRepository::class,
        RoleRepository::class => DoctrineRoleRepository::class,
    ];

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
        if (! Type::hasType(UuidType::UUID)) {
            Type::addType(UuidType::UUID, UuidType::class);
        }
    }

    private function configureMonologSentryHandler()
    {
        if (config('sentry.enabled') && config('sentry.logging.enabled')) {
            $this->app->register(\Sentry\Laravel\ServiceProvider::class);
        }
    }
}
