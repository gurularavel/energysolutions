<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stat extends Model
{
    use HasTranslations;

    public array $translatable = ['label'];

    protected $fillable = [
        'number',
        'label',
        'speed',
        'sort_order',
    ];
}
