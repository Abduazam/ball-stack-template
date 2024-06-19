<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Information\App\Actions\Language\DestroyLanguageAction;
use Modules\Information\App\Models\Language\Language;

class Destroy extends Component
{
    use DispatchingTrait;

    public Language $language;

    public function destroy(): void
    {
        $response = (new ActionHandler)->handle(
            new DestroyLanguageAction($this->language)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view('livewire.information.language.destroy');
    }
}
