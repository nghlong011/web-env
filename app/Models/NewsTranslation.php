<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'locale',
        'news_id',
        'content',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'h1',
        'alt_text'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
} 