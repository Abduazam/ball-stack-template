<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageValidRule implements ValidationRule
{
    protected int $maxSize = 5 * 1024 * 1024;
    protected array $mimes = ['jpeg', 'png', 'jpg', 'gif', 'svg'];

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && $value instanceof TemporaryUploadedFile) {
            if ($value->getSize() > $this->maxSize) {
                $fail(__('validation.max.file.size', ['attribute' => $attribute, 'max' => $this->maxSize]));
            }

            if (! in_array($value->getClientOriginalExtension(), $this->mimes, true) && ! $value->isFile()) {
                $fail(__('validation.mime', ['attribute' => $attribute]));
            }
        }
    }
}
