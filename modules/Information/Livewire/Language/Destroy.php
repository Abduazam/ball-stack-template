<?php

namespace Modules\Information\Livewire\Language;

use App\Contracts\Traits\Livewire\Dispatches\DispatchingTrait;
use App\Handlers\Action\ActionHandler;
use Illuminate\Contracts\View\View;
use Modules\Information\App\Actions\Language\DestroyLanguageAction;
use Modules\Information\App\Models\Language\Language;
use Modules\Information\Contracts\Abstracts\Livewire\Language\Base;

final class Destroy extends Base
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
        return view($this->path . 'destroy');
    }
}
