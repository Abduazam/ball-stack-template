<?php

namespace Modules\Management\App\Actions\Role;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Management\App\Models\Role\Role;

class DeleteRoleAction implements Actionable
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
