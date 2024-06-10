<?php

namespace Modules\Management\Commands\Permission;

use App\Contracts\Interfaces\Command\Commandable;
use App\Models\Management\Permission;
use Modules\Management\DTO\Permission\PermissionDTO;

class UpdatePermissionCommand implements Commandable
{
    protected Permission $permission;
    protected PermissionDTO $dto;

    public function __construct(Permission $permission, array $data)
    {
        $this->permission = $permission;
        $this->dto = new PermissionDTO($data);
    }

    public function run(): int
    {
        $this->permission->update($this->dto->toArray());

        return $this->permission->id;
    }
}
