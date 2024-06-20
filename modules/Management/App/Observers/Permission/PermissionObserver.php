<?php

namespace Modules\Management\App\Observers\Permission;

use Modules\Management\App\Models\Permission\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        cache()->forget('permissions');
        cache()->forget('permission.' . $permission->id);
    }
}
