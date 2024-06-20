<?php

namespace Modules\Management\App\Repositories\Permissions;

use App\Contracts\Interfaces\Repository\Repositorable;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\App\Filters\Permission\PermissionFilterQuery;

class PermissionRepository implements Repositorable
{
    public function all(): Collection
    {
        return (new PermissionFilterQuery)
            ->cachable('permissions')
            ->relations('roles')
            ->get();
    }

    public function findById(int $id): ?Model
    {
        return (new PermissionFilterQuery)
            ->cachable("permission.{$id}")
            ->closure(function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->first();
    }

    public function findByClosure(Closure $function): Collection
    {
        return (new PermissionFilterQuery)
            ->closure($function)
            ->get();
    }

    public function filter(string $search, int $perPage): Collection|LengthAwarePaginator
    {
        return (new PermissionFilterQuery)
            ->count('roles')
            ->search($search)
            ->get($perPage);
    }
}
