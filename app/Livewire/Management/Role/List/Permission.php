<?php

namespace App\Livewire\Management\Role\List;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Models\Management\Role;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Permission extends Component
{
    use PaginationTrait;

    public Role $role;

    public function render(): View
    {
        return view('livewire.management.role.list.permission', [
            'permissions' => $this->role->permissions()->paginate($this->perPage),
        ]);
    }
}
