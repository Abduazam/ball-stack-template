<?php

namespace Modules\Management\App\Repositories\Permissions;

use App\Contracts\Interfaces\Repository\Repositorable;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\App\Filters\Permission\PermissionFilterQuery;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements Repositorable
{
    public function all(): Collection
    {
        return Permission::with('roles')->get();
    }

    public function findById(int $id): ?Permission
    {
        return Permission::where('id', $id)->first();
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
