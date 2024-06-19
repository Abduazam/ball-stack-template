<?php

namespace Modules\Information\App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Columns
 * @property $id
 * @property $imageable_type
 * @property $imageable_id
 * @property $path
 * @property $created_at
 * @property $updated_at
 *
 * Relations
 * @property $imageable
 */
class Image extends Model
{
    use HasFactory, Relations;

    protected $fillable = [
        'path'
    ];
}
