<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\Commands\Role\UpdateRoleCommand;
use Modules\Management\Http\Forms\Role\RoleForm;
use Modules\Management\Http\Methods\Role\RoleMethods;
use Modules\Management\Repositories\Permissions\PermissionRepository;

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

        $response = (new CommandHandler)->handle(
            new UpdateRoleCommand($this->role, $validated)
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
