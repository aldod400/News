<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotsTxt extends Model
{
    use HasFactory;

    protected $table = 'robots_txt';

    protected $fillable = [
        'content',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get the active robots.txt content
     */
    public static function getActiveContent()
    {
        $robotsTxt = self::where('is_active', true)->first();
        
        if (!$robotsTxt) {
            // Default robots.txt content if none exists
            return "User-agent: *\nDisallow:";
        }
        
        return $robotsTxt->content;
    }

    /**
     * Set a robots.txt as active and deactivate others
     */
    public function setAsActive()
    {
        // Deactivate all other robots.txt entries
        self::where('id', '!=', $this->id)->update(['is_active' => false]);
        
        // Activate this one
        $this->update(['is_active' => true]);
    }
}
