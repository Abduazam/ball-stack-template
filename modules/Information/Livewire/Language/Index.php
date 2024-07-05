<?php

namespace Modules\Information\Livewire\Language;

use App\Contracts\Traits\Livewire\Filters\Paginatable;
use App\Contracts\Traits\Livewire\Filters\Searchable;
use App\Contracts\Traits\Livewire\Filters\Trasheable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Information\App\Repositories\Language\LanguageRepository;
use Modules\Information\Contracts\Abstracts\Livewire\Language\Base;

#[Lazy]
final class Index extends Base
{
    use Searchable, Trasheable, Paginatable;

    protected $listeners = ['refresh' => '$refresh'];

    public function render(LanguageRepository $languageRepository): View
    {
        return view($this->path . 'index', [
            'languages' => $languageRepository->filter(
                $this->search,
                $this->trashed,
                $this->perPage
            )
        ]);
    }
}
