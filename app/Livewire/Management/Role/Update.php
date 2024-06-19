<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\App\Actions\Role\UpdateRoleAction;
use Modules\Management\App\Http\Forms\Role\RoleForm;
use Modules\Management\App\Http\Methods\Role\RoleMethods;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;

#[Lazy]
class Update extends Component
{
    use DispatchingTrait, RoleMethods;

    public Role $role;

    public RoleForm $form;

    public function mount(): void
    {
        $this->form->bind($this->role);
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new UpdateRoleAction($this->role, $validated)
        );

        $this->handleResponse($response, 'role', 'view');
    }

    public function render(PermissionRepository $permissionRepository): View
    {
        $permissions = $permissionRepository->all();

        $this->setDefaultPermissions($permissions->where('is_default', true));

        return view('livewire.management.role.update', [
            'permissions' => collect($permissions)->groupBy(function ($permission) {
                                $parts = explode('.', $permission->name);

                                return $parts[count($parts) - 2];
                             })
        ]);
    }
}
