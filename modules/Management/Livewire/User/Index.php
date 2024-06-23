<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Management\App\Repositories\User\UserRepository;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

#[Lazy]
final class Index extends Base
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
