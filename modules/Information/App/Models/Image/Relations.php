<?php

namespace Modules\Information\App\Models\Image;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait Relations
{
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
