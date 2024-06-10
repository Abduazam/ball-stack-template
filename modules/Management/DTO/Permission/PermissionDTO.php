<?php

namespace Modules\Management\DTO\Permission;

use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class PermissionDTO implements ObjectTransferable
{
    public bool $isDefault;
    public array $description;

    public function __construct(array $data)
    {
        $this->isDefault = $data['is_default'];
        $this->description = $data['description'];
    }

    public function toArray(): array
    {
        return [
            'is_default' => $this->isDefault,
            'description' => json_encode($this->description),
        ];
    }

    public function toNonNullArray(): array
    {
        return array_filter($this->toArray(), function ($value) {
            return !is_null($value);
        });
    }
}
