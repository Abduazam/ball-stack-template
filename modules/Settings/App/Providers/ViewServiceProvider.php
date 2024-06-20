<?php

namespace Modules\Settings\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Settings\App\Livewire\Import;
use Modules\Settings\App\Livewire\Profile;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'settings';
    protected string $wireName = 'wire-settings';

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', $this->namespace);

        $this->loadLivewireViews($this->wireName);
    }

    public function loadLivewireViews(string $namespace): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/livewire', $namespace);

        Livewire::component('settings.profile', Profile::class);
        Livewire::component('settings.import', Import::class);
    }
}
