<?php

namespace Modules\Information\App\Actions\Language;

use App\Contracts\Interfaces\Action\Actionable;
use Modules\Information\App\Models\Language\Language;

class DeleteLanguageAction implements Actionable
{
    public function __construct(protected Language $language)
    {
        //
    }

    public function run()
    {
        $this->language->delete();

        return $this->language->id;
    }
}
