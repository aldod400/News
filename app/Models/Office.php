<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'address' => 'array',
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
     * Get address in the current language
     */
    public function getAddressAttribute($value)
    {
        if (!$value) return '';
        
        $addresses = is_array($value) ? $value : json_decode($value, true);
        if (!is_array($addresses)) return $value;
        
        $currentLang = app()->getLocale();
        return $addresses[$currentLang] ?? $addresses['en'] ?? '';
    }

    /**
     * Get raw name array for editing
     */
    public function getRawNameAttribute()
    {
        return json_decode($this->attributes['name'], true) ?? [];
    }

    /**
     * Get raw address array for editing
     */
    public function getRawAddressAttribute()
    {
        return json_decode($this->attributes['address'], true) ?? [];
    }

    /**
     * Scope for active offices
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
