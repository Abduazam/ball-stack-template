<?php

namespace App\Livewire\Management\Role\List;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Management\App\Models\Role\Role;

class User extends Component
{
    use PaginationTrait;

    public Role $role;

    public function render(): View
    {
        return view('livewire.management.role.list.user', [
            'users' => $this->role->users()->paginate($this->perPage)
        ]);
    }
}
