<?php

namespace Modules\Management\Filters\Role;

use App\Models\Management\Role;
use App\Contracts\Abstracts\Filters\FilterQuery;

class RoleFilterQuery extends FilterQuery
{
    public function __construct()
    {
        $this->builder = Role::query();
    }

    public function search(string $search): static
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAll(['name'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
