<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class GalleryCategory extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'filter_class',
        'sort_order',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->orderBy('sort_order');
    }
}
