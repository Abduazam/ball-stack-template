<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\App\Policies\Language\LanguagePolicy;
use Modules\Management\App\Models\Permission\Permission;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\App\Policies\Permission\PermissionPolicy;
use Modules\Management\App\Policies\Role\RolePolicy;
use Modules\Management\App\Policies\User\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        $this->registerPolicies();

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    private function registerPolicies(): void
    {
        # Information
        Gate::policy(Language::class, LanguagePolicy::class);

        # Management
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
    }
}
