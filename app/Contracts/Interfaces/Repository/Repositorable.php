<?php

namespace App\Contracts\Interfaces\Repository;

use Closure;
use Illuminate\Database\Eloquent\Collection;

interface Repositorable
{
    public function all(): Collection;

    public function findById(int $id);

    public function findByClosure(Closure $function): Collection;
}
