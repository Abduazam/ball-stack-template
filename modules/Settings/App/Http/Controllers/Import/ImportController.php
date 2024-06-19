<?php

namespace Modules\Settings\App\Http\Controllers\Import;

use App\Contracts\Enums\Folder\FolderPathEnum;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ImportController extends Controller
{
    protected string $path = FolderPathEnum::IMPORT->value;

    public function __invoke(): View
    {
        return view($this->path);
    }
}
