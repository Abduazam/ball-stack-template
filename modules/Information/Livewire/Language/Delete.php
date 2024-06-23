<?php

namespace Modules\Information\Livewire\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Modules\Information\App\Actions\Language\DeleteLanguageAction;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\Contracts\Abstracts\Livewire\Language\Base;

final class Delete extends Base
{
    use DispatchingTrait;

    public Language $language;

    public function delete(): void
    {
        $response = (new ActionHandler)->handle(
            new DeleteLanguageAction($this->language)
        );

        $this->handleResponse($response, 'language');
    }

    #[On('updated')]
    public function render(): View
    {
        return view($this->path . 'delete');
    }
}
