<?php

namespace Modules\Management\App\Providers;

use App\Contracts\Interfaces\Provider\ProviderLivewireable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ViewServiceProvider extends ServiceProvider implements ProviderLivewireable
{
    protected string $namespace = 'management';
    protected string $wireName = 'wire-management';

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
            'management.user' => [
                'create' => \Modules\Management\App\Livewire\User\Create::class,
                'delete' => \Modules\Management\App\Livewire\User\Delete::class,
                'destroy' => \Modules\Management\App\Livewire\User\Destroy::class,
                'index' => \Modules\Management\App\Livewire\User\Index::class,
                'restore' => \Modules\Management\App\Livewire\User\Restore::class,
                'update' => \Modules\Management\App\Livewire\User\Update::class,
            ],

            'management.role' => [
                'create' => \Modules\Management\App\Livewire\Role\Create::class,
                'delete' => \Modules\Management\App\Livewire\Role\Delete::class,
                'destroy' => \Modules\Management\App\Livewire\Role\Destroy::class,
                'index' => \Modules\Management\App\Livewire\Role\Index::class,
                'restore' => \Modules\Management\App\Livewire\Role\Restore::class,
                'update' => \Modules\Management\App\Livewire\Role\Update::class,
                'list.user' => \Modules\Management\App\Livewire\Role\List\User::class,
                'list.permission' => \Modules\Management\App\Livewire\Role\List\Permission::class
            ],

            'management.permission' => [
                'index' => \Modules\Management\App\Livewire\Permission\Index::class,
                'update' => \Modules\Management\App\Livewire\Permission\Update::class,
            ]
        ];

        foreach ($components as $context => $componentList) {
            foreach ($componentList as $alias => $class) {
                Livewire::component("{$context}.{$alias}", $class);
            }
        }
    }
}