<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'description',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    /**
     * Get description in the current language
     */
    public function getDescriptionAttribute($value)
    {
        if (!$value) return '';
        
        $descriptions = is_array($value) ? $value : json_decode($value, true);
        if (!is_array($descriptions)) return $value;
        
        $currentLang = app()->getLocale();
        return $descriptions[$currentLang] ?? $descriptions['en'] ?? '';
    }

    /**
     * Get raw description array for editing
     */
    public function getRawDescriptionAttribute()
    {
        return json_decode($this->attributes['description'], true) ?? [];
    }
}
