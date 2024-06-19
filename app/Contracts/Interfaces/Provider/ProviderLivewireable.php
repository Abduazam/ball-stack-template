<?php

namespace App\Contracts\Interfaces\Provider;

interface ProviderLivewireable
{
    public function loadLivewireViews(string $namespace);
}
