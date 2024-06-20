<?php

namespace Modules\Management\App\Providers;

use Illuminate\Support\ServiceProvider;

class ManagementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PolicyServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
    }
}
