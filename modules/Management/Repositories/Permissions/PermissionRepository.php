<?php

namespace Modules\Management\Repositories\Permissions;

use App\Contracts\Enums\Route\RoutePathEnum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Management\Filters\Permission\PermissionFilterQuery;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function all(): Collection
    {
        return Permission::with('roles')->get();
    }

    public function findById(int $id): ?Permission
    {
        return Permission::where('id', $id)->first();
    }

    public function imports()
    {
        return Permission::where('name', 'like', '%.import')
            ->where('name', '!=', RoutePathEnum::IMPORT->value)->get();
    }

    public function filter(string $search, int $perPage): Collection|LengthAwarePaginator
    {
        return (new PermissionFilterQuery)
            ->count('roles')
            ->search($search)
            ->get($perPage);
    }
}
