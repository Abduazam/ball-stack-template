<?php

namespace Modules\Management\App\DTOs\Role;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class RoleImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $name;
    public string $users;
    public string $permissions;

    public function __construct(array $data)
    {
        $this->name = $data[1];
        $this->users = $data[2];
        $this->permissions = $data[3];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guardName(),
        ];
    }

    private function guardName(): string
    {
        return config('auth.defaults.guard');
    }
}
