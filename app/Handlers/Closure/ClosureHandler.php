<?php

namespace App\Handlers\Closure;

use Closure;
use Illuminate\Support\Facades\DB;
use Throwable;

class ClosureHandler
{
    public function handle(Closure $service): Throwable|int|bool
    {
        try {
            return DB::transaction(function () use ($service) {
                return $service();
            });
        } catch (Throwable $exception) {
            return $exception;
        }
    }
}
