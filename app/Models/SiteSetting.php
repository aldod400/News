<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description'
    ];

    protected $casts = [
        'value' => 'string'
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        // Handle different data types
        switch ($setting->type) {
            case 'json':
                return json_decode($setting->value, true);
            case 'boolean':
                return (bool) $setting->value;
            case 'integer':
                return (int) $setting->value;
            case 'float':
                return (float) $setting->value;
            default:
                return $setting->value;
        }
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $group = 'general', $description = null)
    {
        // Convert value based on type
        if ($type === 'json' && is_array($value)) {
            $value = json_encode($value);
        } elseif ($type === 'boolean') {
            $value = $value ? '1' : '0';
        }

        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'description' => $description
            ]
        );
    }

    /**
     * Get all settings by group
     */
    public static function getGroup($group)
    {
        return self::where('group', $group)->get()->pluck('value', 'key');
    }

    /**
     * Get company information
     */
    public static function getCompanyInfo()
    {
        return [
            'name' => self::get('company_name', 'News Company'),
            'address' => self::get('company_address', ''),
            'city' => self::get('company_city', ''),
            'country' => self::get('company_country', ''),
            'phone' => self::get('company_phone', ''),
            'email' => self::get('company_email', ''),
            'website' => self::get('site_url', url('/')),
            'latitude' => self::get('company_latitude', ''),
            'longitude' => self::get('company_longitude', ''),
        ];
    }

    /**
     * Get SEO settings
     */
    public static function getSeoSettings()
    {
        return [
            'sitemap_enabled' => self::get('sitemap_enabled', true),
            'sitemap_news_enabled' => self::get('sitemap_news_enabled', true),
            'sitemap_categories_enabled' => self::get('sitemap_categories_enabled', true),
            'sitemap_frequency' => self::get('sitemap_frequency', 'daily'),
            'sitemap_priority' => self::get('sitemap_priority', '0.8'),
        ];
    }
}
