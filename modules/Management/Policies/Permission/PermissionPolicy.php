<?php

namespace Modules\Management\Policies\Permission;

use App\Contracts\Enums\Route\RoutePathEnum;
use App\Models\Management\Permission;
use App\Models\Management\User;

final class PermissionPolicy
{
    protected string $route = RoutePathEnum::PERMISSION->value;

    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo($this->route . 'show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo($this->route . 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(User $user, Permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently export the model.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'export');
    }
}
