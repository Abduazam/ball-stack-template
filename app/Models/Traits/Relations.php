<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Information\App\Models\Image\Image;

trait Relations
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
