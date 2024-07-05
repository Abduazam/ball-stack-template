<?php

namespace Modules\Management\App\DTOs\Permission;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;
use App\Contracts\Traits\DTOs\Guardable\GuardName;

readonly class PermissionImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    use GuardName;

    public string $name;
    public array $description;
    public bool $isDefault;

    public function __construct(array $data)
    {
        $description = $this->offsetArrayKey($data, 3);

        $data = array_values($data);

        $this->name = $data[1];
        $this->isDefault = $data[2];
        $this->description = $description;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guardName(),
            'is_default' => $this->isDefault,
        ];
    }
}
