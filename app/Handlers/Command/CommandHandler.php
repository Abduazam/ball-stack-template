<?php

namespace App\Handlers\Command;

use App\Contracts\Interfaces\Command\Commandable;
use Illuminate\Support\Facades\DB;
use Throwable;

class CommandHandler
{
    public function handle(Commandable $service): Throwable|int|bool
    {
        try {
            return DB::transaction(fn() => $service->run());
        } catch (Throwable $exception) {
            return $exception;
        }
    }
}
