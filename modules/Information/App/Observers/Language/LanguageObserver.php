<?php

namespace Modules\Information\App\Observers\Language;


use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\File;
use Modules\Information\App\Models\Language\Language;

class LanguageObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Language "created" event.
     */
    public function created(Language $language): void
    {
        $currentLocale = app()->getLocale();

        $sourcePath = base_path("lang/{$currentLocale}");

        $destinationPath = base_path("lang/{$language->slug}");

        if (File::exists($sourcePath)) {
            File::copyDirectory($sourcePath, $destinationPath);
        }

        cache()->forget('languages');
    }

    /**
     * Handle the Language "updated" event.
     */
    public function updated(Language $language): void
    {
        cache()->forget('languages');
        cache()->forget('language.' . $language->id);
    }

    /**
     * Handle the Language "deleted" event.
     */
    public function deleted(Language $language): void
    {
        cache()->forget('languages');
    }

    /**
     * Handle the Language "restored" event.
     */
    public function restored(Language $language): void
    {
        cache()->forget('languages');
    }

    /**
     * Handle the Language "force deleted" event.
     */
    public function forceDeleted(Language $language): void
    {
        $destinationPath = base_path("lang/{$language->slug}");

        if (File::exists($destinationPath)) {
            File::deleteDirectory($destinationPath);
        }

        cache()->forget('languages');
        cache()->forget('language.' . $language->id);
    }
}
