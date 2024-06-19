<?php

namespace Modules\Management\App\Actions\Role;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Management\App\Models\Role\Role;

class RestoreRoleAction implements Actionable
{
    public function __construct(protected Role $role)
    {
        //
    }

    public function run()
    {
        $this->role->restore();

        return $this->role->id;
    }
}
