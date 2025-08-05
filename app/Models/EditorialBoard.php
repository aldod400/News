<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorialBoard extends Model
{
    use HasFactory;

    protected $table = 'editorial_board';

    protected $fillable = [
        'name',
        'position',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get name in the current language
     */
    public function getNameAttribute($value)
    {
        if (!$value) return '';
        
        $names = is_array($value) ? $value : json_decode($value, true);
        if (!is_array($names)) return $value;
        
        $currentLang = app()->getLocale();
        return $names[$currentLang] ?? $names['en'] ?? '';
    }

    /**
     * Get position in the current language
     */
    public function getPositionAttribute($value)
    {
        if (!$value) return '';
        
        $positions = is_array($value) ? $value : json_decode($value, true);
        if (!is_array($positions)) return $value;
        
        $currentLang = app()->getLocale();
        return $positions[$currentLang] ?? $positions['en'] ?? '';
    }

    /**
     * Get raw name array for editing
     */
    public function getRawNameAttribute()
    {
        return json_decode($this->attributes['name'], true) ?? [];
    }

    /**
     * Get raw position array for editing
     */
    public function getRawPositionAttribute()
    {
        return json_decode($this->attributes['position'], true) ?? [];
    }

    /**
     * Scope for active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
