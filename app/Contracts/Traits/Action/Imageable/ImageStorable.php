<?php

namespace App\Contracts\Traits\Action\Imageable;

use App\Models\User;

trait ImageStorable
{
    private function addNewImage(User $user): void
    {
        $path = $this->dto->image->store('users/avatars', 'public');

        $user->image()->create([
            'path' => $path,
        ]);
    }
}
