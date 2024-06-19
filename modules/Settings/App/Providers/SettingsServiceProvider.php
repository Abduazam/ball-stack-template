<?php

namespace Modules\Settings\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Settings\App\Livewire\Import;
use Modules\Settings\App\Livewire\Profile;

class SettingsServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    public function boot(): void
    {
        $this->app->register(SettingsRouteServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', 'settings');

        $this->loadLivewireViews('wire-settings');
    }

    public function loadLivewireViews(string $namespace): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/livewire', $namespace);

        Livewire::component('settings.profile', Profile::class);
        Livewire::component('settings.import', Import::class);
    }
}
