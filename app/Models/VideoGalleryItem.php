<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class VideoGalleryItem extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = ['title', 'youtube_url', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getYoutubeId(): ?string
    {
        $url = $this->youtube_url;
        if (!$url) return null;

        // https://youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_\-]{11})/', $url, $m)) {
            return $m[1];
        }
        // https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_\-]{11})/', $url, $m)) {
            return $m[1];
        }
        // https://www.youtube.com/embed/VIDEO_ID
        if (preg_match('/embed\/([a-zA-Z0-9_\-]{11})/', $url, $m)) {
            return $m[1];
        }

        return null;
    }

    public function getThumbnailUrl(): string
    {
        if ($this->hasMedia('thumbnail')) {
            return $this->getFirstMediaUrl('thumbnail');
        }

        $id = $this->getYoutubeId();
        if ($id) {
            return "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
        }

        return asset('assets/images/resources/video-placeholder.jpg');
    }

    public function getEmbedUrl(): string
    {
        $id = $this->getYoutubeId();
        return $id ? "https://www.youtube.com/embed/{$id}?autoplay=1&rel=0" : '';
    }
}
