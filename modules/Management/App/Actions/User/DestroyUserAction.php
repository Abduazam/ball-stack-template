<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Models\User;

class DestroyUserAction implements Actionable
{
    public function __construct(protected User $user)
    {
        //
    }

    public function run()
    {
        $this->user->forceDelete();

        return $this->user->id;
    }
}
