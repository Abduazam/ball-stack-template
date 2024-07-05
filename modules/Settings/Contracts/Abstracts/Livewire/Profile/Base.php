<?php

namespace Modules\Settings\Contracts\Abstracts\Livewire\Profile;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::PROFILE->value;
    protected string $model = 'profile';
    protected string $type = 'view';
}
