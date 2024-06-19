<?php

namespace App\Livewire\Information\Language;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Modules\Information\App\Repositories\Language\LanguageRepository;

#[Lazy]
class Index extends Component
{
    use SearchTrait, TrashedTrait, PaginationTrait;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(LanguageRepository $languageRepository): View
    {
        return view('livewire.information.language.index', [
            'languages' => $languageRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
