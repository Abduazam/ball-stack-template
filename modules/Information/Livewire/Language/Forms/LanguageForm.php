<?php

namespace Modules\Information\Livewire\Language\Forms;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Modules\Information\App\Models\Language\Language;

class LanguageForm extends Form
{
    #[Locked]
    public ?int $languageId = null;

    #[Validate(as: 'fields.columns.language.slug', translate: true)]
    public ?string $slug = null;

    #[Validate(as: 'fields.columns.language.title', translate: true)]
    public ?string $title = null;

    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:5', Rule::unique('languages', 'slug')->ignore($this->languageId)],
            'title' => ['required', 'string', 'min:3'],
        ];
    }

    public function bind(Language $language): void
    {
        $this->languageId = $language->id;
        $this->slug = $language->slug;
        $this->title = $language->title;
    }
}
