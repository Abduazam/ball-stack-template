<?php

namespace Modules\Management\Livewire\Permission;

use App\Contracts\Traits\Livewire\Filters\Paginatable;
use App\Contracts\Traits\Livewire\Filters\Searchable;
use App\Contracts\Traits\Livewire\Filters\Trasheable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Management\Contracts\Abstracts\Livewire\Permission\Base;

#[Lazy]
final class Index extends Base
{
    use Searchable, Trasheable, Paginatable;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(PermissionRepository $permissionRepository): View
    {
        return view($this->path . 'index', [
            'permissions' => $permissionRepository->filter(
                $this->search,
                $this->perPage
            )
        ]);
    }
}
