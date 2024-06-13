<?php

namespace Modules\Information\Commands\Language;

use App\Models\Information\Language;
use App\Contracts\Interfaces\Command\Commandable;

class RestoreLanguageCommand implements Commandable
{
    public function __construct(protected Language $language)
    {
        //
    }

    public function run()
    {
        $this->language->restore();

        return $this->language->id;
    }
}
