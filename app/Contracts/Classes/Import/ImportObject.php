<?php

namespace App\Contracts\Classes\Import;

use App\Contracts\Enums\Route\RoutePathEnum;
use InvalidArgumentException;
use Modules\Management\Imports\Role\RoleImport;
use Modules\Management\Imports\User\UserImport;

class ImportObject
{
    protected array $imports = [
        RoutePathEnum::USER->value . 'import' => UserImport::class,
        RoutePathEnum::ROLE->value . 'import' => RoleImport::class,
    ];

    public function take(string $key)
    {
        if (! array_key_exists($key, $this->imports)) {
            throw new InvalidArgumentException("The key '$key' does not exist in imports.");
        }

        $import = $this->imports[$key];

        return new $import();
    }
}