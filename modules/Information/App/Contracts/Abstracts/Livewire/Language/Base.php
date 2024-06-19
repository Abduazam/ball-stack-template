<?php

namespace Modules\Information\App\Contracts\Abstracts\Livewire\Language;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::LANGUAGE->value;
}
