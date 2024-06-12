<?php

namespace Modules\Settings\Http\Forms\Import;

use App\Rules\ImportSectionRule;
use Livewire\Attributes\Validate;
use Livewire\Form;

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
