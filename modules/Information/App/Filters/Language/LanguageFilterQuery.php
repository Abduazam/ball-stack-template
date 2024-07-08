<?php

namespace Modules\Information\App\Filters\Language;

use App\Contracts\Abstracts\Filter\AbstractFilterQuery;
use Modules\Information\App\Models\Language\Language;

final class LanguageFilterQuery extends AbstractFilterQuery
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
