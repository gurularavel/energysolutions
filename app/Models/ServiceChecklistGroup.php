<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ServiceChecklistGroup extends Model
{
    use HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'service_id',
        'group_key',
        'title',
        'sort_order',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
