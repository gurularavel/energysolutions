<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    public array $translatable = ['company_name', 'address', 'footer_copyright'];

    protected $fillable = [
        'company_name',
        'phone',
        'email',
        'address',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'pinterest_url',
        'youtube_url',
        'footer_copyright',
        'complaint_form_pdf',
        'order_form_pdf',
        'policy_pdf',
        'default_locale',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('sticky_logo')->singleFile();
        $this->addMediaCollection('mobile_logo')->singleFile();
        $this->addMediaCollection('footer_logo')->singleFile();
    }

    public static function instance(): self
    {
        return static::firstOrCreate([]);
    }
}
