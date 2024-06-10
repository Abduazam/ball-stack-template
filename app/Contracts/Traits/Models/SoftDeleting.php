<?php

namespace App\Contracts\Traits\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeleting
{
    use SoftDeletes;

    public function status(): string
    {
        if ($this->trashed()) {
            return '<span class="badge bg-alt-warning">' . trans('fields.filters.inactive') . '</span>';
        }

        return '<span class="badge bg-alt-success">' . trans('fields.filters.active') . '</span>';
    }
}
