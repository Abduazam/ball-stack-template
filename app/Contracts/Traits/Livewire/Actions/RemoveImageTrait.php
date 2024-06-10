<?php

namespace App\Contracts\Traits\Livewire\Actions;

trait RemoveImageTrait
{
    public function removeImage(): void
    {
        $this->form->image = null;
    }
}
