<?php

namespace Modules\Management\App\Livewire\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Actions\Role\CreateRoleAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\Role\Base;
use Modules\Management\App\Http\Forms\Role\RoleForm;
use Modules\Management\App\Http\Methods\Role\RoleMethods;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;

#[Lazy]
class Create extends Base
{
    use DispatchingTrait, RoleMethods;

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

        $this->handleResponse($response, 'role', 'view');
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
