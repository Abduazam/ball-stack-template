<?php

namespace App\Livewire\Management\Permission;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Modules\Management\Commands\Permission\UpdatePermissionCommand;
use Modules\Management\Http\Forms\Permission\PermissionForm;

class Update extends Component
{
    use DispatchingTrait;

    public Permission $permission;

    public PermissionForm $form;

    public function mount(): void
    {
        $this->form->bind($this->permission);
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        $validated = $this->form->validate();

        $response = (new CommandHandler)->handle(
            new UpdatePermissionCommand($this->permission, $validated)
        );

        $this->handleResponse($response, 'permission');
    }

    public function render(): View
    {
        return view('livewire.management.permission.update');
    }
}
