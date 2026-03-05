<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ServiceChecklistItem extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = ['content'];

    protected $fillable = [
        'service_id',
        'content',
        'section_group',
        'item_type',
        'sort_order',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('item_image')->singleFile();
    }
}
