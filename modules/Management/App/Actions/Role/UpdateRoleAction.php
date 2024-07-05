<?php

namespace Modules\Management\App\Actions\Role;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Management\App\DTOs\Role\RoleDTO;
use Modules\Management\App\Models\Role\Role;

class UpdateRoleAction implements Actionable
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

        $this->role->syncPermissions($this->dto->permissions);

        return $this->role->id;
    }
}
