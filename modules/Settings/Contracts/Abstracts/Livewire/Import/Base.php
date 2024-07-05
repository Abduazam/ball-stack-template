<?php

namespace Modules\Settings\Contracts\Abstracts\Livewire\Import;

use App\Contracts\Enums\Folder\WireFolderPathEnum;
use Livewire\Component;

abstract class Base extends Component
{
    protected string $path = WireFolderPathEnum::IMPORT->value;
    protected string $model = 'import';
    protected string $type = 'view';
}
