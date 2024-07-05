<?php

namespace Modules\Management\Contracts\Abstracts\Livewire\Role;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::ROLE->value;

    protected string $model = 'role';

    protected string $type = 'view';
}
