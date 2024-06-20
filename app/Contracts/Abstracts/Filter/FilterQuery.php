<?php

namespace App\Contracts\Abstracts\Filter;

use App\Contracts\Enums\Immutables\CacheTimeEnum;
use App\Contracts\Traits\Filter\FilterQueryCachable;
use App\Contracts\ValueObjects\CacheTime;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class FilterQuery
{
    use FilterQueryCachable;

    const LIMIT = 50;
    const ORDER_BY = 'id';
    const ORDER_DIRECTION = 'asc';

    protected Builder $builder;

    public function cachable(string $key, ?CacheTime $cacheTime = null): static
    {
        $this->cachable = true;
        $this->key = $key;
        $this->time = $cacheTime?->getValue() ?? CacheTimeEnum::forever();

        return $this;
    }

    public function relations(...$relations): static
    {
        $this->builder->with($relations);

        return $this;
    }

    public function trashed(int $trashed): static
    {
        $this->builder->when($trashed, function ($query) {
            $query->onlyTrashed();
        });

        return $this;
    }

    public function count(...$relations): static
    {
        $this->builder->withCount($relations);

        return $this;
    }

    public function closure(Closure $function): static
    {
        $function($this->builder);

        return $this;
    }

    public function sort(string $orderBy = self::ORDER_BY, string $direction = self::ORDER_DIRECTION): static
    {
        $this->builder->orderBy($orderBy, $direction);

        return $this;
    }

    public function limit(int $limit = self::LIMIT): static
    {
        $this->builder->limit($limit);

        return $this;
    }

    public function first(): ?Model
    {
        if ($this->cachable) {
            return $this->firstCache();
        }

        return $this->builder->first();
    }

    public function get(int $perPage = 0): Collection|LengthAwarePaginator
    {
        if ($this->cachable) {
            return $this->getCache();
        }

        return $perPage === 0 ? $this->builder->get() : $this->builder->paginate($perPage);
    }
}
