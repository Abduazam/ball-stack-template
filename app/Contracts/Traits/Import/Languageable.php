<?php

namespace App\Contracts\Traits\Import;

trait Languageable
{
    private function existingLanguages(): array
    {
        return $this->languageRepository->all()
            ->pluck('slug')
            ->toArray();
    }
}
