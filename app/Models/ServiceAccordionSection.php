<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ServiceAccordionSection extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = ['title', 'content'];

    protected $fillable = [
        'service_id',
        'title',
        'content',
        'sort_order',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('accordion_images');
    }
}
