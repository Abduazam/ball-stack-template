<?php

namespace Modules\Management\App\Actions\User;

use App\Contracts\Interfaces\Action\Actionable;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DestroyUserAction implements Actionable
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
