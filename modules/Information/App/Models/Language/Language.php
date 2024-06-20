<?php

namespace Modules\Information\App\Models\Language;

use App\Contracts\Traits\Models\SoftDeleting;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Information\App\Observers\Language\LanguageObserver;

/**
 * Columns
 * @property $id
 * @property $slug
 * @property $title
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 */
#[ObservedBy(LanguageObserver::class)]
class Language extends Model
{
    use HasFactory, SoftDeleting;

    protected $fillable = [
        'slug',
        'title',
    ];
}
