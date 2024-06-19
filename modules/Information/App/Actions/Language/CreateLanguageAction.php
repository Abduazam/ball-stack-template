<?php

namespace Modules\Information\App\Actions\Language;

use App\Contracts\Interfaces\Action\Actionable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\File;
use Modules\Information\App\DTOs\Language\LanguageDTO;
use Modules\Information\App\Models\Language\Language;

class CreateLanguageAction implements Actionable
{
    protected LanguageDTO $dto;

    public function __construct(array $data)
    {
        $this->dto = new LanguageDTO($data);
    }

    /**
     * @throws ConnectionException
     */
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
