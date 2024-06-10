<?php

namespace App\Livewire\Management\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Management\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Management\Commands\User\DeleteUserCommand;

class Delete extends Component
{
    use DispatchingTrait;

    public User $user;

    public function delete(): void
    {
        $response = (new CommandHandler)->handle(
            new DeleteUserCommand($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    #[On('updated')]
    public function render(): View
    {
        return view('livewire.management.user.delete');
    }
}
