<?php

namespace App\Rules;

use App\Contracts\Classes\Import\ImportObject;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ImportSectionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! in_array($value, ImportObject::getImports())) {
            $fail(__('validation.custom.import.cant', ['attribute' => $attribute]));
        }
    }
}
