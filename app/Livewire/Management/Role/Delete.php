<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Management\App\Actions\Role\DeleteRoleAction;
use Modules\Management\App\Models\Role\Role;

class Delete extends Component
{
    use DispatchingTrait;

    public Role $role;

    public function delete(): void
    {
        $response = (new ActionHandler)->handle(
            new DeleteRoleAction($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    #[On('updated')]
    public function render(): View
    {
        return view('livewire.management.role.delete');
    }
}
