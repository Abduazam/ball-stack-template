<?php

namespace Modules\Management\DTO\Role;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class RoleDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $name;
    public array $permissions;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->permissions = $data['permissions'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
