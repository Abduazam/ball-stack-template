<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\Role;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\Commands\Role\DestroyRoleCommand;

class Destroy extends Component
{
    use DispatchingTrait;

    public Role $role;

    public function destroy(): void
    {
        $response = (new CommandHandler)->handle(
            new DestroyRoleCommand($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    public function render(): View
    {
        return view('livewire.management.role.destroy');
    }
}
