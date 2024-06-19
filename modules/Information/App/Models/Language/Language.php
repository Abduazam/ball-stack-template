<?php

namespace Modules\Information\App\Models\Language;

use App\Contracts\Traits\Models\SoftDeleting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $slug
 * @property $title
 */
class Language extends Model
{
    use HasFactory, SoftDeleting;

    protected $fillable = [
        'slug',
        'title',
    ];
}
