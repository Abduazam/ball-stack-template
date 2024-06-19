<?php

namespace Modules\Management\App\Livewire\User;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Contracts\Abstracts\Livewire\User\Base;
use Modules\Management\App\Repositories\User\UserRepository;

#[Lazy]
class Index extends Base
{
    use SearchTrait, TrashedTrait, PaginationTrait;

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
