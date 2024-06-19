<?php

namespace Modules\Settings\App\DTOs\Import;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

readonly class ImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $section;
    public TemporaryUploadedFile $file;

    public function __construct(array $data)
    {
        $this->section = $data['section'];
        $this->file = $data['file'];
    }

    public function toArray(): array
    {
        return [
            'section' => $this->section,
            'file' => $this->file,
        ];
    }
}
