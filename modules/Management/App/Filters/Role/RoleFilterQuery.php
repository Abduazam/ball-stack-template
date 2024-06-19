<?php

namespace Modules\Management\App\Filters\Role;

use App\Contracts\Abstracts\Filter\FilterQuery;
use Modules\Management\App\Models\Role\Role;

final class RoleFilterQuery extends FilterQuery
{
    public function __construct()
    {
        $this->builder = Role::query();
    }

    public function search(string $search): RoleFilterQuery
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAll(['name'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
