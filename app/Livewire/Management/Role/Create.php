<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\Commands\Role\CreateRoleCommand;
use Modules\Management\Http\Forms\Role\RoleForm;
use Modules\Management\Http\Methods\Role\RoleMethods;
use Modules\Management\Repositories\Permissions\PermissionRepository;

#[Lazy]
class Create extends Component
{
    use DispatchingTrait, RoleMethods;

    public RoleForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): void
    {
        $validated = $this->form->validate();

        $response = (new CommandHandler)->handle(
            new CreateRoleCommand($validated)
        );

        $this->handleResponse($response, 'role', 'view');
    }

    public function render(PermissionRepository $permissionRepository): View
    {
        $permissions = $permissionRepository->all();

        $this->setDefaultPermissions($permissions->where('is_default', true));

        return view('livewire.management.role.create', [
            'permissions' => collect($permissions)->groupBy(function ($permission) {
                                $parts = explode('.', $permission->name);

                                return $parts[count($parts) - 2];
                             })
        ]);
    }
}
