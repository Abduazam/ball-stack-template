<?php

namespace Modules\Management\Livewire\Role;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Modules\Management\App\Actions\Role\DeleteRoleAction;
use Modules\Management\App\Models\Role\Role;
use Modules\Management\Contracts\Abstracts\Livewire\Role\Base;

final class Delete extends Base
{
    use DispatchingTrait;

    public Role $role;

    public function delete(): void
    {
        $response = (new ActionHandler)->handle(
            new DeleteRoleAction($this->role)
        );

        $this->handleResponse($response, 'role');
    }

    #[On('updated')]
    public function render(): View
    {
        return view($this->path . 'delete');
    }
}
