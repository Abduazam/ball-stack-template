<?php

namespace Modules\Management\App\Repositories\Role;

use App\Contracts\Interfaces\Repository\Repositorable;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\App\Filters\Role\RoleFilterQuery;
use Modules\Management\App\Models\Role\Role;

class RoleRepository implements Repositorable
{
    public function all(): Collection
    {
        return Role::with('users', 'permissions')
            ->where('name', '!=', 'super-admin')
            ->get();
    }

    public function findById(int $id): ?Role
    {
        return Role::where('id', $id)->first();
    }

    public function findByName(string $role): ?Role
    {
        return Role::where('name', $role)->first();
    }

    public function findByClosure(Closure $function): Collection
    {
        return (new RoleFilterQuery)
            ->closure($function)
            ->get();
    }

    public function filter(string $search, int $trashed, int $perPage): Collection|LengthAwarePaginator
    {
        return (new RoleFilterQuery)
            ->count('users', 'permissions')
            ->closure(function ($query) {
                $query->where('name', '!=', 'super-admin');
            })
            ->trashed($trashed)
            ->search($search)
            ->sort()
            ->get($perPage);
    }
}
