<?php

namespace Modules\Information\Filter\Language;

use App\Models\Information\Language;
use App\Contracts\Abstracts\Filters\FilterQuery;

final class LanguageFilterQuery extends FilterQuery
{
    public function __construct()
    {
        $this->builder = Language::query();
    }

    public function search(string $search): LanguageFilterQuery
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAny(['slug', 'title'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
