<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @property $id
 * @property $name
 * @property $description
 * @property $is_default
 *
 * Relations
 * @property $roles
 */
class Permission extends SpatiePermission
{
    use HasFactory;

    public function default(): string
    {
        if ($this->is_default) {
            return '<span class="badge bg-alt-success">' . trans('fields.filters.default') . '</span>';
        }

        return '<span class="badge bg-alt-danger">' . trans('fields.filters.not_default') . '</span>';
    }
}
