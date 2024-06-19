<?php

namespace Modules\Management\App\DTOs\Permission;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class PermissionImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $name;
    public string $description;
    public bool $isDefault;

    public function __construct(array $data)
    {
        $this->name = $data[1];
        $this->description = $data[2];
        $this->isDefault = $data[3];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'guard_name' => $this->guardName(),
            'description' => $this->description(),
            'is_default' => $this->isDefault,
        ];
    }

    private function guardName(): string
    {
        return config('auth.defaults.guard');
    }

    private function description(): false|string|null
    {
        if (blank($this->description)) {
            return null;
        }

        $decoded = json_decode($this->description, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return json_encode($decoded);
        }

        return json_encode(['error' => 'Invalid JSON']);
    }
}
