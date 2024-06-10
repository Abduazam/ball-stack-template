<?php

namespace Modules\Management\Filters\Permission;

use App\Models\Management\Permission;
use App\Contracts\Abstracts\Filters\FilterQuery;

class PermissionFilterQuery extends FilterQuery
{
    public function __construct()
    {
        $this->builder = Permission::query();
    }

    public function search(string $search): static
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAll(['name'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
