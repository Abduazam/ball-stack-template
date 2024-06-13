<?php

namespace Modules\Information\Commands\Language;

use App\Contracts\Interfaces\Command\Commandable;
use App\Models\Information\Language;
use Illuminate\Support\Facades\File;
use Modules\Information\DTO\Language\LanguageDTO;

class CreateLanguageCommand implements Commandable
{
    protected LanguageDTO $dto;

    public function __construct(array $data)
    {
        $this->dto = new LanguageDTO($data);
    }

    public function run(): int
    {
        $language = Language::create($this->dto->toArray());

        $currentLocale = app()->getLocale();

        $sourcePath = base_path("lang/{$currentLocale}");

        $destinationPath = base_path("lang/{$language->slug}");

        if (File::exists($sourcePath)) {
            File::copyDirectory($sourcePath, $destinationPath);
        }

        return $language->id;
    }
}
