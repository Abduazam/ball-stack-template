<?php

namespace Modules\Information\Commands\Language;

use App\Contracts\Interfaces\Command\Commandable;
use App\Models\Information\Language;
use Modules\Information\DTO\Language\LanguageDTO;

class UpdateLanguageCommand implements Commandable
{
    protected Language $language;
    protected LanguageDTO $dto;

    public function __construct(Language $language, array $data)
    {
        $this->language = $language;
        $this->dto = new LanguageDTO($data);
    }

    public function run(): int
    {
        $this->language->update($this->dto->toArray());

        return $this->language->id;
    }
}
