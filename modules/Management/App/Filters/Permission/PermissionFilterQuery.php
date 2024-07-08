<?php

namespace Modules\Management\App\Filters\Permission;

use App\Contracts\Abstracts\Filter\AbstractFilterQuery;
use Modules\Management\App\Models\Permission\Permission;

final class PermissionFilterQuery extends AbstractFilterQuery
{
    public function __construct()
    {
        $this->builder = Permission::query();
    }

    public function search(string $search): PermissionFilterQuery
    {
        $this->builder->when($search, function ($query, $search) {
            $query->whereAll(['name'], 'like', '%' . $search . '%');
        });

        return $this;
    }
}
