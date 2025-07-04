<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'parent_id',
        'image_path'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function translations()
    {
        return $this->hasMany(SettingTranslation::class);
    }

    public function translation($locale = 'vi')
    {
        return $this->translations()->where('language', $locale)->first();
    }

    public function parent()
    {
        return $this->belongsTo(Setting::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Setting::class, 'parent_id');
    }
}
