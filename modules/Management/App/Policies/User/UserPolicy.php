<?php

namespace Modules\Management\App\Policies\User;

use App\Contracts\Enums\Route\RoutePathEnum;
use App\Models\User;

final class UserPolicy
{
    protected string $route = RoutePathEnum::USER->value;

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
    public function show(User $user, User $model): bool
    {
        return $user->hasPermissionTo($this->route . 'show')
                && !$model->trashed();
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
    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo($this->route . 'edit')
                && !$model->trashed();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo($this->route . 'delete')
                && !$model->trashed() && !$model->self();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasPermissionTo($this->route . 'restore')
                && $model->trashed() && !$model->self();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(User $user, User $model): bool
    {
        return $user->hasPermissionTo($this->route . 'destroy')
                && $model->trashed() && !$model->self();
    }

    /**
     * Determine whether the user can permanently export the model.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'export');
    }
}
