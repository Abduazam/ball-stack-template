<?php

namespace Modules\Information\App\Livewire\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Modules\Information\App\Actions\Language\UpdateLanguageAction;
use Modules\Information\App\Contracts\Abstracts\Livewire\Language\Base;
use Modules\Information\App\Http\Forms\Language\LanguageForm;
use Modules\Information\App\Models\Language\Language;

final class Update extends Base
{
    use DispatchingTrait;

    public Language $language;

    public LanguageForm $form;

    public function mount(): void
    {
        $this->form->bind($this->language);
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        $validated = $this->form->validate();

        $response = (new ActionHandler)->handle(
            new UpdateLanguageAction($this->language, $validated)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view($this->path . 'update');
    }
}
