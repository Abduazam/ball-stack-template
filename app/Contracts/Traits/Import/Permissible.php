<?php

namespace App\Contracts\Traits\Import;

trait Permissible
{
    private function existingPermissions(): array
    {
        return $this->permissionRepository->all()
            ->pluck('name')
            ->toArray();
    }
}
