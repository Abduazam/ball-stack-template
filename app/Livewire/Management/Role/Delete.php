<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\Role;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Management\Commands\Role\DeleteRoleCommand;

class Delete extends Component
{
    use DispatchingTrait;

    public Role $role;

    public function delete(): void
    {
        $response = (new CommandHandler)->handle(
            new DeleteRoleCommand($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    #[On('updated')]
    public function render(): View
    {
        return view('livewire.management.role.delete');
    }
}
