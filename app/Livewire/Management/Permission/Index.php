<?php

namespace App\Livewire\Management\Permission;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\Repositories\Permissions\PermissionRepository;

#[Lazy]
class Index extends Component
{
    use SearchTrait, TrashedTrait, PaginationTrait;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(PermissionRepository $permissionRepository): View
    {
        return view('livewire.management.permission.index', [
            'permissions' => $permissionRepository->filter(
                $this->search,
                $this->perPage
            )
        ]);
    }
}
