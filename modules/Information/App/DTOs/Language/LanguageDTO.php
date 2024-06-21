<?php

namespace Modules\Information\App\DTOs\Language;

use App\Contracts\Abstracts\DTO\AbstractObjectTransfer;
use App\Contracts\Interfaces\DTO\ObjectTransferable;

readonly class LanguageDTO extends AbstractObjectTransfer implements ObjectTransferable
{
    public string $slug;
    public string $title;

    public function __construct(array $data)
    {
        $this->slug = $data['slug'];
        $this->title = $data['title'];
    }

    public function toArray(): array
    {
        return [
            'slug' => strtolower($this->slug),
            'title' => $this->title,
        ];
    }
}
