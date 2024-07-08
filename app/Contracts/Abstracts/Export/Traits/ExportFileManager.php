<?php

namespace App\Contracts\Abstracts\Export\Traits;

use App\Contracts\Classes\Livewire\ModelTranslation;
use App\Contracts\Enums\Immutables\Export\ExportTypeEnum;

trait ExportFileManager
{
    protected string $path;

    protected ExportTypeEnum $type = ExportTypeEnum::XLSX;

    protected string $folder = 'exports';

    protected string $filename = 'file';

    protected function makeFilename(string $value): void
    {
        $model = new ModelTranslation();

        $translation = $model->take($value);

        $this->filename = trans($translation);
    }

    protected function makeFilepath(): void
    {
        if (! file_exists(public_path($this->folder))) {
            mkdir(public_path($this->folder), 0755, true);
        }

        $this->path = $this->folder . '/' . $this->filename . '.' . $this->type->value;
    }

    protected function path(): string
    {
        return public_path($this->path);
    }
}
