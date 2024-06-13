<?php

namespace Modules\Information\DTO\Language;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class LanguageImportDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $slug;
    public string $title;
    public bool $isDefault;

    public function __construct(array $data)
    {
        $this->slug = $data[1];
        $this->title = $data[2];
    }

    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
        ];
    }
}
