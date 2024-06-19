<?php

namespace Modules\Information\App\Livewire\Language;

use App\Contracts\Traits\Livewire\Filters\PaginationTrait;
use App\Contracts\Traits\Livewire\Filters\SearchTrait;
use App\Contracts\Traits\Livewire\Filters\TrashedTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Modules\Information\App\Contracts\Abstracts\Livewire\Language\Base;
use Modules\Information\App\Repositories\Language\LanguageRepository;

#[Lazy]
final class Index extends Base
{
    use SearchTrait, TrashedTrait, PaginationTrait;

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
