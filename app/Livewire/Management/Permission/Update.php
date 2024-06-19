<?php

namespace App\Livewire\Management\Permission;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Modules\Management\App\Actions\Permission\UpdatePermissionAction;
use Modules\Management\App\Http\Forms\Permission\PermissionForm;
use Modules\Management\App\Models\Permission\Permission;

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

        $response = (new ActionHandler)->handle(
            new UpdatePermissionAction($this->permission, $validated)
        );

        $this->handleResponse($response, 'permission');
    }

    public function render(): View
    {
        return view('livewire.management.permission.update');
    }
}
