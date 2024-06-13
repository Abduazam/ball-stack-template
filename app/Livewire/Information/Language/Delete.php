<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Information\Language;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Information\Commands\Language\DeleteLanguageCommand;

class Delete extends Component
{
    use DispatchingTrait;

    public Language $language;

    public function delete(): void
    {
        $response = (new CommandHandler)->handle(
            new DeleteLanguageCommand($this->language)
        );

        $this->handleResponse($response, 'language');
    }

    #[On('updated')]
    public function render(): View
    {
        return view('livewire.information.language.delete');
    }
}
