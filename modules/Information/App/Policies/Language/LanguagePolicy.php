<?php

namespace Modules\Information\App\Policies\Language;

use App\Contracts\Enums\Immutables\Locale\LanguageEnum;
use App\Contracts\Enums\Route\RoutePathEnum;
use App\Models\User;
use Modules\Information\App\Models\Language\Language;

final class LanguagePolicy
{
    protected string $route = RoutePathEnum::LANGUAGE->value;

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
    public function show(User $user, Language $language): bool
    {
        return $user->hasPermissionTo($this->route . 'show')
                && !$language->trashed();
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
    public function update(User $user, Language $language): bool
    {
        return $user->hasPermissionTo($this->route . 'edit')
                && !$language->trashed();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Language $language): bool
    {
        return $user->hasPermissionTo($this->route . 'delete')
                && !$language->trashed()
                && $language->slug !== app()->getLocale();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Language $language): bool
    {
        return $user->hasPermissionTo($this->route . 'restore')
                && $language->trashed();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(User $user, Language $language): bool
    {
        return $user->hasPermissionTo($this->route . 'destroy')
                && $language->trashed()
                && $language->slug !== app()->getLocale()
                && !in_array($language->slug, LanguageEnum::toArray());
    }

    /**
     * Determine whether the user can permanently export the model.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo($this->route . 'export');
    }
}
