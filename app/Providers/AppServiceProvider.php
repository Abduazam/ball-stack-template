<?php

namespace App\Providers;

use App\Models\Information\Language;
use App\Models\Management\Permission;
use App\Models\Management\Role;
use App\Models\Management\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Information\Policies\Language\LanguagePolicy;
use Modules\Management\Policies\Permission\PermissionPolicy;
use Modules\Management\Policies\Role\RolePolicy;
use Modules\Management\Policies\User\UserPolicy;

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

        $this->loadMigrationsFrom(database_path('migrations/*/'));

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
