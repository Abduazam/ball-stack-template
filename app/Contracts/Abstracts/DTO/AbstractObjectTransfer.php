<?php

namespace App\Contracts\Abstracts\DTO;

readonly abstract class AbstractObjectTransfer
{
    public function toNonNullArray(): array
    {
        return array_filter($this->toArray(), function ($value) {
            return !is_null($value);
        });
    }
}
