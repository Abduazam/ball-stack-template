<?php

namespace Modules\Management\App\Providers;

use App\Models\User;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\Management\App\Models\Permission\Permission;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\App\Policies\Permission\PermissionPolicy;
use Modules\Management\App\Policies\Role\RolePolicy;
use Modules\Management\App\Policies\User\UserPolicy;

class PolicyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
    }
}
