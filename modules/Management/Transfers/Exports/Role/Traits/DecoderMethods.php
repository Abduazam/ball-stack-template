<?php

namespace Modules\Management\Transfers\Exports\Role\Traits;

use Modules\Management\App\Models\Role\Role;

trait DecoderMethods
{
    private function users(Role $role): ?string
    {
        return $role->users->pluck('email')->implode(', ');
    }

    private function permissions(Role $role): ?string
    {
        return $role->permissions->pluck('name')->implode(', ');
    }
}
