<?php

namespace Modules\Management\Livewire\User;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Modules\Management\App\Actions\User\DestroyUserAction;
use Modules\Management\Contracts\Abstracts\Livewire\User\Base;

final class Destroy extends Base
{
    use DispatchingTrait;

    public User $user;

    public function destroy(): void
    {
        $response = (new ActionHandler)->handle(
            new DestroyUserAction($this->user)
        );

        $this->handleResponse($response, 'user');
    }

    public function render(): View
    {
        return view($this->path . 'destroy');
    }
}
