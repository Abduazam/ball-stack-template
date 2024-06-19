<?php

namespace Modules\Management\App\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Modules\Management\App\Actions\User\DeleteUserAction;
use Modules\Management\App\Contracts\Abstracts\Livewire\User\Base;

class Delete extends Base
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
        return view($this->path . 'delete');
    }
}
