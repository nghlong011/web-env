<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'category',
        'image',
        'status',
        'video_url',
        'document_url'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function translations()
    {
        return $this->hasMany(GalleryTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(GalleryTranslation::class)->where('locale', $locale);
    }
} 