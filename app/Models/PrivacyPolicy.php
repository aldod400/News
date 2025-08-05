<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $table = 'privacy_policy';

    protected $fillable = [
        'title',
        'content',
        'last_updated',
        'is_active'
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
        'last_updated' => 'datetime'
    ];

    /**
     * Get the title in the current language
     */
    public function getTitleAttribute($value)
    {
        $titles = json_decode($value, true);
        $locale = app()->getLocale();
        return $titles[$locale] ?? $titles['en'] ?? '';
    }

    /**
     * Get the content in the current language
     */
    public function getContentAttribute($value)
    {
        $contents = json_decode($value, true);
        $locale = app()->getLocale();
        return $contents[$locale] ?? $contents['en'] ?? '';
    }

    /**
     * Get the active privacy policy
     */
    public static function getActivePolicy()
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Set this policy as active and deactivate others
     */
    public function setAsActive()
    {
        // Deactivate all other policies
        self::where('id', '!=', $this->id)->update(['is_active' => false]);
        
        // Activate this policy
        $this->update(['is_active' => true, 'last_updated' => now()]);
    }

    /**
     * Get formatted last updated date
     */
    public function getFormattedLastUpdatedAttribute()
    {
        if ($this->last_updated) {
            return $this->last_updated->translatedFormat('j F Y');
        }
        return $this->updated_at->translatedFormat('j F Y');
    }

    /**
     * Scope for active policies
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
