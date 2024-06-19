<?php

namespace Modules\Information\App\Livewire\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Modules\Information\App\Actions\Language\CreateLanguageAction;
use Modules\Information\App\Contracts\Abstracts\Livewire\Language\Base;
use Modules\Information\App\Http\Forms\Language\LanguageForm;

final class Create extends Base
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
        return view($this->path . 'create');
    }
}
