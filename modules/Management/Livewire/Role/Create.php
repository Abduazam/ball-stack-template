<?php

namespace Modules\Management\Livewire\Role;

use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Actions\Role\CreateRoleAction;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Management\Contracts\Abstracts\Livewire\Role\Base;
use Modules\Management\Livewire\Role\Forms\RoleForm;
use Modules\Management\Livewire\Role\Methods\PermissionMethods;

#[Lazy]
final class Create extends Base
{
    use Dispatchable, PermissionMethods;

    public RoleForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new CreateRoleAction($validated)
        );

        $this->handleResponse($response, $this->model, $this->type);
    }

    public function render(PermissionRepository $permissionRepository): View
    {
        $permissions = $permissionRepository->all();

        $this->setDefaultPermissions($permissions->where('is_default', true));

        return view($this->path . 'create', [
            'permissions' => collect($permissions)->groupBy(function ($permission) {
                $parts = explode('.', $permission->name);

                return $parts[count($parts) - 2];
            })
        ]);
    }
}
