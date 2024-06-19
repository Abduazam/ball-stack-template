<?php

namespace Modules\Settings\App\Http\Forms\Import;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Modules\Settings\App\Rules\ImportSectionRule;

class ImportForm extends Form
{
    #[Validate(as: 'fields.columns.import.section', translate: true)]
    public ?string $section = null;

    #[Validate(as: 'fields.columns.import.file', translate: true)]
    public mixed $file = null;

    public function rules(): array
    {
        return [
            'section' => ['required', 'string', 'exists:permissions,name', new ImportSectionRule],
            'file' => ['required', 'file', 'mimes:xlsx,xls'],
        ];
    }
}
