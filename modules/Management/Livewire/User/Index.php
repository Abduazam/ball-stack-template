<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Filters\Paginatable;
use App\Contracts\Traits\Livewire\Filters\Searchable;
use App\Contracts\Traits\Livewire\Filters\Trasheable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Repositories\User\UserRepository;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

#[Lazy]
final class Index extends Base
{
    use Searchable, Trasheable, Paginatable;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(UserRepository $userRepository): View
    {
        return view($this->path . 'index', [
            'users' => $userRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
