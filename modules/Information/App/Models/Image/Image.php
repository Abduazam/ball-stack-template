<?php

namespace Modules\Information\App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
