<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Information\App\Actions\Language\RestoreLanguageAction;
use Modules\Information\App\Models\Language\Language;

class Restore extends Component
{
    use DispatchingTrait;

    public Language $language;

    public function restore(): void
    {
        $response = (new ActionHandler)->handle(
            new RestoreLanguageAction($this->language)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view('livewire.information.language.restore');
    }
}
