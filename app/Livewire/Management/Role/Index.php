<?php

namespace App\Livewire\Management\Role;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\App\Repositories\Role\RoleRepository;

#[Lazy]
class Index extends Component
{
    use SearchTrait, TrashedTrait, PaginationTrait;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(RoleRepository $roleRepository): View
    {
        return view('livewire.management.role.index', [
            'roles' => $roleRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
