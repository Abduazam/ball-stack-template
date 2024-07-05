<?php

namespace App\Contracts\Traits\Livewire\Filters;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

trait Paginatable
{
    use WithPagination, WithoutUrlPagination;

    public int $perPage = 10;
}
