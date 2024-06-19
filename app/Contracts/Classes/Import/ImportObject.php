<?php

namespace App\Contracts\Classes\Import;

use App\Contracts\Enums\Route\RoutePathEnum;
use InvalidArgumentException;
use Modules\Information\App\DataTransfer\Imports\Language\LanguageImport;
use Modules\Management\App\DataTransfer\Imports\Permission\PermissionImport;
use Modules\Management\App\DataTransfer\Imports\Role\RoleImport;
use Modules\Management\App\DataTransfer\Imports\User\UserImport;

class ImportObject
{
    protected array $imports = [
        # Information
        RoutePathEnum::LANGUAGE->value . 'import' => LanguageImport::class,
        # Management
        RoutePathEnum::USER->value . 'import' => UserImport::class,
        RoutePathEnum::ROLE->value . 'import' => RoleImport::class,
        RoutePathEnum::PERMISSION->value . 'import' => PermissionImport::class,
    ];

    public static function getImports(): array
    {
        $instance = new self();

        return array_keys($instance->imports);
    }

    public function take(string $key)
    {
        if (! array_key_exists($key, $this->imports)) {
            throw new InvalidArgumentException("The key '$key' does not exist in imports.");
        }

        $import = $this->imports[$key];

        return new $import();
    }
}
