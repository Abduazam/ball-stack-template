<?php

namespace Modules\Settings\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Settings\Livewire\Import\Import;
use Modules\Settings\Livewire\Profile\Profile;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'settings';
    protected string $wireName = 'wire-settings';

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', $this->namespace);

        $this->loadLivewireViews($this->wireName);
    }

    public function loadLivewireViews(string $namespace): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources/livewire', $namespace);

        Livewire::component('settings.profile', Profile::class);
        Livewire::component('settings.import', Import::class);
    }
}
