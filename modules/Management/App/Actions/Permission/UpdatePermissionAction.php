<?php

namespace Modules\Management\App\Actions\Permission;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Management\App\DTOs\Permission\PermissionDTO;
use Modules\Management\App\Models\Permission\Permission;

class UpdatePermissionAction implements Actionable
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
