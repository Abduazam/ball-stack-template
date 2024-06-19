<?php

namespace Modules\Management\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ManagementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->app->register(ManagementRouteServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', 'management');

        Blade::anonymousComponentPath(__DIR__ . '/../../Resource/components', 'management');
    }
}
