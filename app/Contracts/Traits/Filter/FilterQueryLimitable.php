<?php

namespace App\Contracts\Traits\Filter;

use Illuminate\Pagination\LengthAwarePaginator;

trait FilterQueryLimitable
{
    protected ?int $limit = null;

    private function customPaginate(int $perPage): LengthAwarePaginator
    {
        $result = $this->builder->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $result->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator($currentPageItems, $result->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
    }
}
