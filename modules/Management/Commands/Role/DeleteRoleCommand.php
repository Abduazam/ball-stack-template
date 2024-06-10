<?php

namespace Modules\Management\Commands\Role;

use App\Models\Management\Role;
use App\Contracts\Interfaces\Command\Commandable;

class DeleteRoleCommand implements Commandable
{
    public function __construct(protected Role $role)
    {
        //
    }

    public function run()
    {
        $this->role->delete();

        return $this->role->id;
    }
}
