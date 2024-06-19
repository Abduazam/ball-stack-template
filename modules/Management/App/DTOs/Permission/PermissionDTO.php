<?php

namespace Modules\Management\App\DTOs\Permission;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class PermissionDTO extends AbstractObjectTransfer implements ObjectTransferable
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
}
