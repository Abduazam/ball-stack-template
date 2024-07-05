<?php

namespace Modules\Management\Contracts\Abstracts\Livewire\User;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::USER->value;

    protected string $model = 'user';

    protected string $type = 'view';
}
