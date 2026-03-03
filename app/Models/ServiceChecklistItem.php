<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ServiceChecklistItem extends Model
{
    use HasTranslations;

    public array $translatable = ['content'];

    protected $fillable = [
        'service_id',
        'content',
        'section_group',
        'sort_order',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
