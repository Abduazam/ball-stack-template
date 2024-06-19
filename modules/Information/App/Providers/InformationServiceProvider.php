<?php

namespace Modules\Information\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class InformationServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->app->register(InformationRouteServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../../Resource/views', 'information');

        Blade::anonymousComponentPath(__DIR__ . '/../../Resource/components', 'information');

        $this->loadLivewireViews('wire-information');
    }

    public function loadLivewireViews(string $namespace): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resource/livewire', $namespace);

        $components = [
            # Language
            'information.language.create' => \Modules\Information\App\Livewire\Language\Create::class,
            'information.language.delete' => \Modules\Information\App\Livewire\Language\Delete::class,
            'information.language.destroy' => \Modules\Information\App\Livewire\Language\Destroy::class,
            'information.language.index' => \Modules\Information\App\Livewire\Language\Index::class,
            'information.language.restore' => \Modules\Information\App\Livewire\Language\Restore::class,
            'information.language.update' => \Modules\Information\App\Livewire\Language\Update::class,
        ];

        foreach ($components as $alias => $class) {
            Livewire::component($alias, $class);
        }
    }
}
