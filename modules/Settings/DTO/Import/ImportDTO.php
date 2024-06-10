<?php

namespace Modules\Settings\DTO\Import;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class ImportDTO
{
    public string $section;
    public TemporaryUploadedFile $file;

    public function __construct(array $data)
    {
        $this->section = $data['section'];
        $this->file = $data['file'];
    }
}
