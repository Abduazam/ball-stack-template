<?php

namespace Modules\Management\App\Models\Role;

use App\Contracts\Enums\Role\AdminEnum;
use App\Contracts\Traits\Models\SoftDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property $id
 * @property $name
 *
 * Relations
 * @property $users
 * @property $permissions
 */
class Role extends SpatieRole
{
    use HasFactory, SoftDeleting;

    public function admin(): bool
    {
        return in_array($this->name, AdminEnum::toArray());
    }
}
