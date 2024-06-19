<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Modules\Information\App\Actions\Language\CreateLanguageAction;
use Modules\Information\App\Http\Forms\Language\LanguageForm;

class Create extends Component
{
    use DispatchingTrait;

    public LanguageForm $form;

    /**
     * @throws ValidationException
     */
    public function create(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new CreateLanguageAction($validated)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view('livewire.information.language.create');
    }
}
