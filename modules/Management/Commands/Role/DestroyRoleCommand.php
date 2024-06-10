<?php

namespace Modules\Management\Commands\Role;

use App\Models\Management\Role;
use App\Contracts\Interfaces\Command\Commandable;

class DestroyRoleCommand implements Commandable
{
    public function __construct(protected Role $role)
    {
        //
    }

    public function run()
    {
        $this->role->forceDelete();

        return $this->role->id;
    }
}
