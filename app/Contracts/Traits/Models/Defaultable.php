<?php

namespace App\Contracts\Traits\Models;

trait Defaultable
{
    public function default(): string
    {
        if ($this->is_default) {
            return '<span class="badge bg-alt-success">' . trans('fields.filters.default') . '</span>';
        }

        return '<span class="badge bg-alt-danger">' . trans('fields.filters.not_default') . '</span>';
    }
}
