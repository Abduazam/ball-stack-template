<?php

namespace Modules\Management\Commands\User;

use App\Models\Management\User;
use App\Contracts\Interfaces\Command\Commandable;

class DeleteUserCommand implements Commandable
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
