<?php

namespace Modules\Management\Livewire\Permission;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Repositories\Permissions\PermissionRepository;
use Modules\Management\Contracts\Abstracts\Livewire\Permission\Base;

#[Lazy]
final class Index extends Base
{
    use SearchTrait, TrashedTrait, PaginationTrait;

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
