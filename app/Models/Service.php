<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'title',
        'slug',
        'type',
        'card_icon_class',
        'featured_icon_class',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function accordionSections(): HasMany
    {
        return $this->hasMany(ServiceAccordionSection::class)->orderBy('sort_order');
    }

    public function checklistItems(): HasMany
    {
        return $this->hasMany(ServiceChecklistItem::class)->orderBy('sort_order');
    }

    public function checklistGroups(): HasMany
    {
        return $this->hasMany(ServiceChecklistGroup::class)->orderBy('sort_order');
    }

    public function supportingImages(): HasMany
    {
        return $this->hasMany(ServiceSupportingImage::class)->orderBy('sort_order');
    }

    public function scopeServices($query)
    {
        return $query->where('type', 'service');
    }

    public function scopeExperiments($query)
    {
        return $query->where('type', 'experiment');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('card_image')->singleFile();
        $this->addMediaCollection('breadcrumb_image')->singleFile();
    }
}
