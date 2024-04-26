<?php

declare(strict_types=1);

namespace Trianity\Sqids\Providers;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Trianity\Sqids\SqidsFactory;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        AboutCommand::add(
            'A Hashids / Sqids bridge for Laravel 10, 11',
            fn () => ['Version' => '11.0.2']
        );

        $this->publishes([
            dirname(__FILE__, 3).'/config/sqids.php' => config_path('sqids.php'),
        ], 'config-sqids');

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
            dirname(__FILE__, 3).'/config/sqids.php',
            'sqids'
        );

        $this->registerFactory();
    }

    public function provides(): array
    {
        return [
            'sqids',
        ];
    }

    protected function registerFactory(): void
    {
        $this->app->bind('sqids', function ($app) {
            return new SqidsFactory();
        });
    }
}
