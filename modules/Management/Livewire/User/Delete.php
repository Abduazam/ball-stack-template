<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\Dispatchable;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Modules\Management\App\Actions\User\DeleteUserAction;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

final class Delete extends Base
{
    use Dispatchable;

    public User $user;

    public function delete(): void
    {
        $response = (new ActionHandler)->handle(
            new DeleteUserAction($this->user)
        );

        $this->handleResponse($response, $this->model);
    }

    #[On('updated')]
    public function render(): View
    {
        return view($this->path . 'delete');
    }
}
