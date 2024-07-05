<?php

namespace App\Contracts\ValueObjects;

use App\Contracts\Enums\Immutables\Cache\CacheTimeEnum;
use Exception;

class CacheTime
{
    private int $value;

    /**
     * @throws Exception
     */
    public function __construct(int|CacheTimeEnum $value)
    {
        if ($value instanceof CacheTimeEnum) {
            $this->value = $value->value;
        } else {
            if ($value <= 0) {
                throw new Exception('Cache time value must be greater than 0');
            }

            $this->value = $value;
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
