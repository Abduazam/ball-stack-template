<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Command\CommandHandler;
use App\Models\Information\Language;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Information\Commands\Language\DestroyLanguageCommand;

class Destroy extends Component
{
    use DispatchingTrait;

    public Language $language;

    public function destroy(): void
    {
        $response = (new CommandHandler)->handle(
            new DestroyLanguageCommand($this->language)
        );

        $this->handleResponse($response, 'language');
    }

    public function render(): View
    {
        return view('livewire.information.language.destroy');
    }
}
