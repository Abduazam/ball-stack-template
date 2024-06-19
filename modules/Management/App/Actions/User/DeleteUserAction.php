<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Models\User;

class DeleteUserAction implements Actionable
{
    public function __construct(protected User $user)
    {
        //
    }

    public function run()
    {
        $this->user->delete();

        return $this->user->id;
    }
}
