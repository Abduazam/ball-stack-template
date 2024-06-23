<?php

namespace Modules\Management\Livewire\Role\List;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\Contracts\Abstracts\Livewire\Role\Base;

final class Permission extends Base
{
    use PaginationTrait;

    public Role $role;

    public function render(): View
    {
        return view($this->path . 'list.permission', [
            'permissions' => $this->role->permissions()->paginate($this->perPage),
        ]);
    }
}
