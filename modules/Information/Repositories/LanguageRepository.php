<?php

namespace Modules\Information\Repositories;

use App\Models\Information\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository
{
    public function all(): Collection
    {
        return Language::all();
    }

    public function findById(int $id): ?Language
    {
        return Language::where('id', $id)->first();
    }

    public function findBySlug(string $slug): ?Language
    {
        return Language::where('slug', $slug)->first();
    }
}
