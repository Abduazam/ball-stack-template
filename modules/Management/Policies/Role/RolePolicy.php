<?php

namespace Modules\Management\Policies\Role;

use App\Contracts\Enums\Route\RoutePathEnum;
use App\Models\Management\Role;
use App\Models\Management\User;

class RolePolicy
{
    protected string $route = RoutePathEnum::ROLE->value;

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
    public function show(User $user, Role $role): bool
    {
        return $user->hasPermissionTo($this->route . 'show') && !$role->trashed();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasPermissionTo($this->route . 'edit') && !$role->trashed();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasPermissionTo($this->route . 'delete') && !$role->trashed() && !$role->admin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasPermissionTo($this->route . 'restore') && $role->trashed() && !$role->admin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(User $user, Role $role): bool
    {
        return $user->hasPermissionTo($this->route . 'destroy') && $role->trashed() && !$role->admin();
    }

    /**
     * Determine whether the user can permanently export the model.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'export');
    }
}
