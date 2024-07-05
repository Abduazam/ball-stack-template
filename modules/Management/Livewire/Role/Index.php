<?php

namespace Modules\Management\Livewire\Role;

use App\Contracts\Traits\Livewire\Filters\Paginatable;
use App\Contracts\Traits\Livewire\Filters\Searchable;
use App\Contracts\Traits\Livewire\Filters\Trasheable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Repositories\Role\RoleRepository;
use Modules\Management\Contracts\Abstracts\Livewire\Role\Base;

#[Lazy]
final class Index extends Base
{
    use Searchable, Trasheable, Paginatable;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(RoleRepository $roleRepository): View
    {
        return view($this->path . 'index', [
            'roles' => $roleRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
