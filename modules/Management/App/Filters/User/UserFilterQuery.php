<?php

namespace Modules\Management\App\Filters\User;

use App\Contracts\Abstracts\Filter\AbstractFilterQuery;
use App\Models\User;

final class UserFilterQuery extends AbstractFilterQuery
{
    public function __construct()
    {
        $this->builder = User::query();
    }

    public function search(string $search): UserFilterQuery
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAny(['name', 'email'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
