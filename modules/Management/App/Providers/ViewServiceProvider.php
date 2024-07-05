<?php

namespace Modules\Management\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'management';
    protected string $wireNamespace = 'wire-management';

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
            'user' => [
                'create' => \Modules\Management\Livewire\User\Create::class,
                'delete' => \Modules\Management\Livewire\User\Delete::class,
                'destroy' => \Modules\Management\Livewire\User\Destroy::class,
                'index' => \Modules\Management\Livewire\User\Index::class,
                'restore' => \Modules\Management\Livewire\User\Restore::class,
                'update' => \Modules\Management\Livewire\User\Update::class,
            ],

            'role' => [
                'create' => \Modules\Management\Livewire\Role\Create::class,
                'delete' => \Modules\Management\Livewire\Role\Delete::class,
                'destroy' => \Modules\Management\Livewire\Role\Destroy::class,
                'index' => \Modules\Management\Livewire\Role\Index::class,
                'restore' => \Modules\Management\Livewire\Role\Restore::class,
                'update' => \Modules\Management\Livewire\Role\Update::class,
                'list.user' => \Modules\Management\Livewire\Role\List\User::class,
                'list.permission' => \Modules\Management\Livewire\Role\List\Permission::class
            ],

            'permission' => [
                'index' => \Modules\Management\Livewire\Permission\Index::class,
                'update' => \Modules\Management\Livewire\Permission\Update::class,
            ]
        ];

        foreach ($components as $context => $componentList) {
            foreach ($componentList as $alias => $class) {
                Livewire::component($this->namespace . ".{$context}.{$alias}", $class);
            }
        }
    }
}
