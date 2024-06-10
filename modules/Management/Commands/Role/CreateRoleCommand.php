<?php

namespace Modules\Management\Commands\Role;

use App\Contracts\Interfaces\Command\Commandable;
use App\Models\Management\Role;
use Modules\Management\DTO\Role\RoleDTO;

class CreateRoleCommand implements Commandable
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
