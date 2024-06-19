<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\App\Actions\Role\DestroyRoleAction;
use Modules\Management\App\Models\Role\Role;

class Destroy extends Component
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
        return view('livewire.management.role.destroy');
    }
}
