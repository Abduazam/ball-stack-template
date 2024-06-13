<?php

namespace Modules\Information\Commands\Language;

use App\Models\Information\Language;
use App\Contracts\Interfaces\Command\Commandable;

class DestroyLanguageCommand implements Commandable
{
    public function __construct(protected Language $language)
    {
        //
    }

    public function run()
    {
        $this->language->forceDelete();

        return $this->language->id;
    }
}
