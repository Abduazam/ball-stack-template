<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Information\App\Actions\Language\DeleteLanguageAction;
use Modules\Information\App\Models\Language\Language;

class Delete extends Component
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
        return view('livewire.information.language.delete');
    }
}
