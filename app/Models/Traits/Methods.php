<?php

namespace App\Models\Traits;

trait Methods
{
    public function self(): bool
    {
        return $this->id === auth()->user()->id;
    }
}
