<?php

namespace Modules\Management\Contracts\Abstracts\Livewire\Permission;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::PERMISSION->value;
}
