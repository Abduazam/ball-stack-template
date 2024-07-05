<?php

namespace Modules\Information\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'information';
    protected string $wireNamespace = 'wire-information';

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', $this->namespace);
        $this->loadViewsFrom(__DIR__ . '/../../Resources/livewire', $this->wireNamespace);

        Blade::anonymousComponentPath(__DIR__ . '/../../Resources/components', $this->namespace);

        $this->loadLivewireViews();
    }

    public function loadLivewireViews(): void
    {
        $components = [
            'language' => [
                'create' => \Modules\Information\Livewire\Language\Create::class,
                'delete' => \Modules\Information\Livewire\Language\Delete::class,
                'destroy' => \Modules\Information\Livewire\Language\Destroy::class,
                'index' => \Modules\Information\Livewire\Language\Index::class,
                'restore' => \Modules\Information\Livewire\Language\Restore::class,
                'update' => \Modules\Information\Livewire\Language\Update::class,
            ]
        ];

        foreach ($components as $context => $componentList) {
            foreach ($componentList as $alias => $class) {
                Livewire::component($this->namespace . ".{$context}.{$alias}", $class);
            }
        }
    }
}
