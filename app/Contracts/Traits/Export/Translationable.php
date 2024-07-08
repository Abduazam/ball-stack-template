<?php

namespace App\Contracts\Traits\Export;

use Modules\Information\App\Repositories\Language\LanguageRepository;

trait Translationable
{
    private function bindHeaders(): void
    {
        $languageRepository = new LanguageRepository();

        foreach ($languageRepository->all() as $language) {
            $this->headers[$language->slug] = $language->slug;
        }
    }
}
