<?php

namespace Modules\Information\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'information';
    protected string $wireName = 'wire-information';

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', $this->namespace);

        Blade::anonymousComponentPath(__DIR__ . '/../../Resource/components', $this->namespace);

        $this->loadLivewireViews($this->wireName);
    }

    public function loadLivewireViews(string $namespace): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/livewire', $namespace);

        $components = [
            'information.language' => [
                'create' => \Modules\Information\App\Livewire\Language\Create::class,
                'delete' => \Modules\Information\App\Livewire\Language\Delete::class,
                'destroy' => \Modules\Information\App\Livewire\Language\Destroy::class,
                'index' => \Modules\Information\App\Livewire\Language\Index::class,
                'restore' => \Modules\Information\App\Livewire\Language\Restore::class,
                'update' => \Modules\Information\App\Livewire\Language\Update::class,
            ]
        ];

        foreach ($components as $context => $componentList) {
            foreach ($componentList as $alias => $class) {
                Livewire::component("{$context}.{$alias}", $class);
            }
        }
    }
}
