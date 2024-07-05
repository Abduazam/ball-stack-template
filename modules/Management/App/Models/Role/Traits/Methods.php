<?php

namespace Modules\Management\App\Models\Role\Traits;

use App\Contracts\Enums\Immutables\Role\AdminEnum;

trait Methods
{
    public function admin(): bool
    {
        return in_array($this->name, AdminEnum::toArray());
    }
}
