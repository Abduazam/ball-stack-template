<?php

namespace Modules\Management\Transfers\Exports\User\Traits;

use App\Models\User;

trait DecoderMethods
{
    private function password(): null
    {
        return null;
    }

    private function role(User $user): ?string
    {
        return $user->roles?->first()->name;
    }
}
