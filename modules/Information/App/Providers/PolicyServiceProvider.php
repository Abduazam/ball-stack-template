<?php

namespace Modules\Information\App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\App\Policies\Language\LanguagePolicy;

class PolicyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Language::class, LanguagePolicy::class);
    }
}
