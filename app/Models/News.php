<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'category',
        'order',
        'date',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'boolean'
    ];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }
} 