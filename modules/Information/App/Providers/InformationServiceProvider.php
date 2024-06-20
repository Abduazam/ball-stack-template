<?php

namespace Modules\Information\App\Providers;

use Illuminate\Support\ServiceProvider;

class InformationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
    }
}
