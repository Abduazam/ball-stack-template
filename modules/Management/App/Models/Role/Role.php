<?php

namespace Modules\Management\App\Models\Role;

use App\Contracts\Traits\Models\SoftDeleting;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Management\App\Observers\Role\RoleObserver;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Columns
 * @property $id
 * @property $name
 * @property $guard_name
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * Relations
 * @property $users
 * @property $permissions
 */
#[ObservedBy(RoleObserver::class)]
class Role extends SpatieRole
{
    use HasFactory, Methods, SoftDeleting;
}
