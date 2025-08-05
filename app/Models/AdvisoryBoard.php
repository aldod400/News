<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvisoryBoard extends Model
{
    use HasFactory;

    protected $table = 'advisory_board';

    protected $fillable = [
        'name',
        'job_title',
        'image',
        'order',
        'is_active'
    ];

    protected $casts = [
        'name' => 'array',
        'job_title' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the name in the current language
     */
    public function getNameAttribute($value)
    {
        $names = json_decode($value, true);
        $locale = app()->getLocale();
        return $names[$locale] ?? $names['en'] ?? '';
    }

    /**
     * Get the job title in the current language
     */
    public function getJobTitleAttribute($value)
    {
        $titles = json_decode($value, true);
        $locale = app()->getLocale();
        return $titles[$locale] ?? $titles['en'] ?? '';
    }

    /**
     * Get active members ordered by order field
     */
    public static function getActiveMembers()
    {
        return self::where('is_active', true)
                   ->orderBy('order')
                   ->orderBy('id')
                   ->get();
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/uploads/' . $this->image);
        }
        return asset('img/default-avatar.png');
    }
}
