<?php

namespace Modules\Management\Commands\User;

use App\Models\Management\User;
use App\Contracts\Interfaces\Command\Commandable;
use Illuminate\Support\Facades\Storage;

class DestroyUserCommand implements Commandable
{
    public function __construct(protected User $user)
    {
        //
    }

    public function run()
    {
        $this->deletePreviousImage();

        $this->user->forceDelete();

        return $this->user->id;
    }

    private function deletePreviousImage(): void
    {
        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image->path);

            $this->user->image->delete();
        }
    }
}
