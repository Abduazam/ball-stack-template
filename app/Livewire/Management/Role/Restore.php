<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\App\Actions\Role\RestoreRoleAction;
use Modules\Management\App\Models\Role\Role;

class Restore extends Component
{
    use DispatchingTrait;

    public Role $role;

    public function restore(): void
    {
        $response = (new ActionHandler)->handle(
            new RestoreRoleAction($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    public function render(): View
    {
        return view('livewire.management.role.restore');
    }
}
