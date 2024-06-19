<?php

namespace Modules\Management\App\Actions\Role;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Management\App\DTOs\Role\RoleDTO;
use Modules\Management\App\Models\Role\Role;

class CreateRoleAction implements Actionable
{
    protected RoleDTO $dto;

    public function __construct(array $data)
    {
        $this->dto = new RoleDTO($data);
    }

    public function run(): int
    {
        $role = Role::create($this->dto->toArray());

        $role->givePermissionTo($this->dto->permissions);

        return $role->id;
    }
}
