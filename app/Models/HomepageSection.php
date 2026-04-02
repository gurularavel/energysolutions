<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomepageSection extends Model
{
    use HasTranslations;

    public array $translatable = ['subtitle', 'content', 'button_text', 'page_content'];

    protected $fillable = [
        'section_key',
        'subtitle',
        'content',
        'button_text',
        'button_link',
        'background_image',
        'page_content',
    ];

    public static function getSection(string $key): ?self
    {
        return static::where('section_key', $key)->first();
    }
}
