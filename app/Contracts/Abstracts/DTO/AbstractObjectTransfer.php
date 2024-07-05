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

    public function offsetArrayKey(array $array, int $offset = 1): array
    {
        return array_slice($array, $offset, null, true);
    }
}
