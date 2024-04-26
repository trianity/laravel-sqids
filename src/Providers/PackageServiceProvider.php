<?php

declare(strict_types=1);

namespace Trianity\Hashids\Providers;

use Hashids\Hashids;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Trianity\Hashids\HashidsFactory;
use Trianity\Hashids\HashidsManager;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        AboutCommand::add(
            'A Hashids bridge for Laravel 9, 10',
            fn () => ['Version' => '10.0.2']
        );

        $this->publishes([
            dirname(__FILE__, 3).'/config/hashids.php' => base_path('config/hashids.php'),
        ], 'config-hashids');

        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__FILE__, 3).'/config/hashids.php',
            'hashids'
        );

        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    public function provides(): array
    {
        return [
            'hashids',
            'hashids.factory',
            'hashids.connection',
        ];
    }

    protected function registerFactory(): void
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });

        $this->app->alias('hashids.factory', HashidsFactory::class);
    }

    protected function registerManager(): void
    {
        $this->app->singleton('hashids', function (Container $app) {
            $config = $app['config'];
            $factory = $app['hashids.factory'];

            return new HashidsManager($config, $factory);
        });

        $this->app->alias('hashids', HashidsManager::class);
    }

    protected function registerBindings(): void
    {
        $this->app->bind('hashids.connection', function (Container $app) {
            $manager = $app['hashids'];

            return $manager->connection();
        });

        $this->app->alias('hashids.connection', Hashids::class);
    }
}
