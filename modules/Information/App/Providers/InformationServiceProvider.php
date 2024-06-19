<?php

namespace Modules\Information\App\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class InformationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->app->register(InformationRouteServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', 'information');

        Blade::anonymousComponentPath(__DIR__ . '/../../Resource/components', 'information');
    }
}
