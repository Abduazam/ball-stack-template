<?php

namespace Modules\Settings\App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->register(SettingsRouteServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', 'settings');
    }
}
