<?php

namespace Modules\Information\App\Actions\Language;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Information\App\DTOs\Language\LanguageDTO;
use Modules\Information\App\Models\Language\Language;

class UpdateLanguageAction implements Actionable
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
