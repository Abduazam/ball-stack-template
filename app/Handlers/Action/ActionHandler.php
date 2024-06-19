<?php

namespace App\Handlers\Action;

use App\Contracts\Interfaces\Action\Actionable;
use Illuminate\Support\Facades\DB;
use Throwable;

class ActionHandler
{
    public function handle(Actionable $action): Throwable|int|bool
    {
        try {
            return DB::transaction(fn() => $action->run());
        } catch (Throwable $exception) {
            return $exception;
        }
    }
}
