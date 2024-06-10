<?php

namespace Modules\Management\Filters\User;

use App\Models\Management\User;
use App\Contracts\Abstracts\Filters\FilterQuery;

class UserFilterQuery extends FilterQuery
{
    public function __construct()
    {
        $this->builder = User::query();
    }

    public function search(string $search): static
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAny(['name', 'email'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
