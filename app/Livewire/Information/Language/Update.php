<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Information\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Modules\Information\Commands\Language\UpdateLanguageCommand;
use Modules\Information\Http\Forms\Language\LanguageForm;

class Update extends Component
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

        $response = (new CommandHandler)->handle(
            new UpdateLanguageCommand($this->language, $validated)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view('livewire.information.language.update');
    }
}
