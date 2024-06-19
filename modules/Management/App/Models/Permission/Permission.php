<?php

namespace Modules\Management\App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Columns
 * @property $id
 * @property $name
 * @property $description
 * @property $is_default
 * @property $created_at
 * @property $updated_at
 *
 * Relations
 * @property $roles
 */
class Permission extends SpatiePermission
{
    use HasFactory, Methods;
}
