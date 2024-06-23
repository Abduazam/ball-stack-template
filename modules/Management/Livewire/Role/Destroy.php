<?php

namespace Modules\Management\Livewire\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\Role\DestroyRoleAction;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\Contracts\Abstracts\Livewire\Role\Base;

final class Destroy extends Base
{
    use DispatchingTrait;

    public Role $role;

    public function destroy(): void
    {
        $response = (new ActionHandler)->handle(
            new DestroyRoleAction($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    public function render(): View
    {
        return view($this->path . 'destroy');
    }
}
