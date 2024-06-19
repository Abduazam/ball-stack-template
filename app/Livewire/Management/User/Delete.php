<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Management\App\Actions\User\DeleteUserAction;

class Delete extends Component
{
    use DispatchingTrait;

    public User $user;

    public function delete(): void
    {
        $response = (new ActionHandler)->handle(
            new DeleteUserAction($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    #[On('updated')]
    public function render(): View
    {
        return view('livewire.management.user.delete');
    }
}
