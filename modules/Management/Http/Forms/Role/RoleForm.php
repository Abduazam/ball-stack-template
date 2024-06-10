<?php

namespace Modules\Management\Http\Forms\Role;

use App\Models\Management\Role;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Modules\Management\Repositories\Permissions\PermissionRepository;

class RoleForm extends Form
{
    #[Locked]
    public ?int $roleId = null;

    #[Validate(as: 'fields.columns.role.name', translate: true)]
    public ?string $name = null;

    #[Validate(as: 'fields.columns.role.permissions', translate: true)]
    public bool $all = false;

    #[Validate(as: 'fields.columns.role.permissions', translate: true)]
    public array $permissions = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:20', Rule::unique('roles', 'name')->ignore($this->roleId)],
            'all' => ['required', 'bool'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }

    public function bind(Role $role): void
    {
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions?->pluck('id')->toArray();
        $this->all = count($this->permissions) === (new PermissionRepository)->all()->count();
    }
}
