<?php

namespace App\Contracts\Traits\Filter;

use Illuminate\Support\Facades\Cache;

trait FilterQueryCachable
{
    protected bool $cachable = false;
    protected string $key = '';
    protected int $time = 0;

    private function firstCache()
    {
        if ($this->time > 0) {
            return Cache::remember($this->key, $this->time, function () {
                return $this->builder->first();
            });
        }

        return Cache::rememberForever($this->key, function () {
            return $this->builder->first();
        });
    }

    private function getCache()
    {
        if ($this->time > 0) {
            return Cache::remember($this->key, $this->time, function () {
                return $this->builder->get();
            });
        }

        return Cache::rememberForever($this->key, function () {
            return $this->builder->get();
        });
    }
}
