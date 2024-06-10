<?php

namespace Modules\Management\Commands\Role;

use App\Contracts\Interfaces\Command\Commandable;
use App\Models\Management\Role;
use Modules\Management\DTO\Role\RoleDTO;

class UpdateRoleCommand implements Commandable
{
    protected Role $role;
    protected RoleDTO $dto;

    public function __construct(Role $role, array $data)
    {
        $this->role = $role;
        $this->dto = new RoleDTO($data);
    }

    public function run(): int
    {
        $this->role->update($this->dto->toArray());

        $newPermissions = $this->dto->permissions;

        $currentPermissions = $this->role->permissions;

        $this->revokePermissions($newPermissions, $currentPermissions);

        $this->givePermissions($newPermissions, $currentPermissions);

        return $this->role->id;
    }

    private function revokePermissions($newPermissions, $currentPermissions): void
    {
        $permissionsToRemove = $currentPermissions->reject(function ($permission) use ($newPermissions) {
            return in_array($permission->id, $newPermissions);
        });

        $this->role->revokePermissionTo($permissionsToRemove);
    }

    private function givePermissions($newPermissions, $currentPermissions): void
    {
        $permissions = collect($newPermissions)->diff($currentPermissions->pluck('id')->toArray());

        $this->role->givePermissionTo($permissions);
    }
}
