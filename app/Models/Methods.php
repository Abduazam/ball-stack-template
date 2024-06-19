<?php

namespace App\Models;

trait Methods
{
    public function self(): bool
    {
        return $this->id === auth()->user()->id;
    }
}
