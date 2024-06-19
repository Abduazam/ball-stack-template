<?php

namespace Modules\Management\App\Livewire\Permission;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Modules\Management\App\Actions\Permission\UpdatePermissionAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\Permission\Base;
use Modules\Management\App\Http\Forms\Permission\PermissionForm;
use Modules\Management\App\Models\Permission\Permission;

final class Update extends Base
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
        return view($this->path . 'update');
    }
}
