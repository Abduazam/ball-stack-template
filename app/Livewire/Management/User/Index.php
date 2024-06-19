<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Management\App\Repositories\User\UserRepository;

#[Lazy]
class Index extends Component
{
    use SearchTrait, TrashedTrait, PaginationTrait;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(UserRepository $userRepository): View
    {
        return view('livewire.management.user.index', [
            'users' => $userRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
