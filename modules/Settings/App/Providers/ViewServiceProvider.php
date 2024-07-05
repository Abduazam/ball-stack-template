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
    protected string $wireNamespace = 'wire-settings';

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', $this->namespace);
        $this->loadViewsFrom(__DIR__ . '/../../Resources/livewire', $this->wireNamespace);

        $this->loadLivewireViews();
    }

    public function loadLivewireViews(): void
    {
        Livewire::component('settings.profile', Profile::class);
        Livewire::component('settings.import', Import::class);
    }
}
