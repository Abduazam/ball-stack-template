<?php

namespace Modules\Management\Repositories\User;

use App\Models\Management\User;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\Filters\User\UserFilterQuery;

class UserRepository
{
    public function all(): Collection
    {
        return User::with('roles')->get();
    }

    public function findById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
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
