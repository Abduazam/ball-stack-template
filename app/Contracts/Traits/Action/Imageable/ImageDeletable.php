<?php

namespace App\Contracts\Traits\Action\Imageable;

use Illuminate\Support\Facades\Storage;

trait ImageDeletable
{
    private function deletePreviousImage(): void
    {
        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image->path);

            $this->user->image->delete();
        }
    }
}
