<?php

namespace Modules\Management\App\Models\Role;

use App\Contracts\Enums\Immutables\AdminEnum;

trait Methods
{
    public function admin(): bool
    {
        return in_array($this->name, AdminEnum::toArray());
    }
}
