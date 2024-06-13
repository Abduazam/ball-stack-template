<?php

namespace Modules\Management\Repositories\User;

use App\Contracts\Interfaces\Repository\Repositorable;
use App\Models\Management\User;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\Filters\User\UserFilterQuery;

class UserRepository implements Repositorable
{
    public function all(): Collection
    {
        return (new UserFilterQuery)
            ->relations('roles')
            ->get();
    }

    public function findById(int $id): ?Model
    {
        return (new UserFilterQuery)
            ->closure(function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->first();
    }

    public function findByEmail(string $email): ?Model
    {
        return (new UserFilterQuery)
            ->closure(function ($query) use ($email) {
                return $query->where('email', $email);
            })
            ->first();
    }

    public function findByClosure(Closure $function): Collection
    {
        return (new UserFilterQuery)
            ->closure($function)
            ->get();
    }

    public function filter(string $search, int $trashed, int $perPage): Collection|LengthAwarePaginator
    {
        return (new UserFilterQuery)
            ->relations('roles')
            ->trashed($trashed)
            ->search($search)
            ->get($perPage);
    }
}
