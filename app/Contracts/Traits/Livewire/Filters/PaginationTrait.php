<?php

namespace App\Contracts\Traits\Livewire\Filters;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

trait PaginationTrait
{
    use WithPagination, WithoutUrlPagination;

    public int $perPage = 10;
}
