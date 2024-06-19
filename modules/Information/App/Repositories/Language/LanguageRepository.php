<?php

namespace Modules\Information\App\Repositories\Language;

use App\Contracts\Interfaces\Repository\Repositorable;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Information\App\Filters\Language\LanguageFilterQuery;

class LanguageRepository implements Repositorable
{
    public function all(): Collection
    {
        return (new LanguageFilterQuery)->get();
    }

    public function findById(int $id): ?Model
    {
        return (new LanguageFilterQuery)
            ->closure(function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->first();
    }

    public function findBySlug(string $slug): ?Model
    {
        return (new LanguageFilterQuery)
            ->closure(function ($query) use ($slug) {
                return $query->where('slug', $slug);
            })
            ->first();
    }

    public function findByClosure(Closure $function): Collection
    {
        return (new LanguageFilterQuery)
            ->closure($function)
            ->get();
    }

    public function filter(string $search, int $trashed, int $perPage): Collection|LengthAwarePaginator
    {
        return (new LanguageFilterQuery)
            ->trashed($trashed)
            ->search($search)
            ->get($perPage);
    }
}
