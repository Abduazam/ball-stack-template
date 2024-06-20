<?php

namespace Modules\Management\App\Repositories\Role;

use App\Contracts\Interfaces\Repository\Repositorable;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\App\Filters\Role\RoleFilterQuery;

class RoleRepository implements Repositorable
{
    public function all(): Collection
    {
        return (new RoleFilterQuery)
            ->cachable('roles')
            ->relations('users', 'permissions')
            ->closure(function ($query) {
                return $query->where('name', '!=', 'super-admin');
            })
            ->get();
    }

    public function findById(int $id): ?Model
    {
        return (new RoleFilterQuery)
            ->cachable("role.{$id}")
            ->closure(function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->first();
    }

    public function findByName(string $name): ?Model
    {
        return (new RoleFilterQuery)
            ->cachable("role.{$name}")
            ->closure(function ($query) use ($name) {
                return $query->where('name', $name);
            })
            ->first();
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
