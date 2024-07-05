<?php

namespace Modules\Management\App\Models\Permission;

use App\Contracts\Traits\Models\Defaultable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Management\App\Observers\Permission\PermissionObserver;
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
#[ObservedBy(PermissionObserver::class)]
class Permission extends SpatiePermission
{
    use HasFactory, Defaultable;
}
