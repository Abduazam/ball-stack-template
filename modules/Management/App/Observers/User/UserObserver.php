<?php

namespace Modules\Management\App\Observers\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        cache()->forget('users');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        cache()->forget('users');
        cache()->forget('user.' . $user->id);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        cache()->forget('users');
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        cache()->forget('users');
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image->path);
        }

        cache()->forget('users');
        cache()->forget('user.' . $user->id);
    }
}
