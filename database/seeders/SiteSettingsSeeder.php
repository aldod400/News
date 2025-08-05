<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'موقع الأخبار',
                'type' => 'text',
                'group' => 'general',
                'description' => 'اسم الموقع الظاهر في العنوان'
            ],
            [
                'key' => 'site_url',
                'value' => url('/'),
                'type' => 'text',
                'group' => 'general',
                'description' => 'رابط الموقع الأساسي'
            ],

            // Company Information
            [
                'key' => 'company_name',
                'value' => 'شركة الأخبار المحدودة',
                'type' => 'text',
                'group' => 'company',
                'description' => 'اسم الشركة'
            ],
            [
                'key' => 'company_address',
                'value' => 'شارع التحرير، وسط البلد',
                'type' => 'textarea',
                'group' => 'company',
                'description' => 'عنوان الشركة بالتفصيل'
            ],
            [
                'key' => 'company_city',
                'value' => 'القاهرة',
                'type' => 'text',
                'group' => 'company',
                'description' => 'المدينة'
            ],
            [
                'key' => 'company_country',
                'value' => 'مصر',
                'type' => 'text',
                'group' => 'company',
                'description' => 'الدولة'
            ],
            [
                'key' => 'company_phone',
                'value' => '+20-2-12345678',
                'type' => 'text',
                'group' => 'company',
                'description' => 'رقم الهاتف'
            ],
            [
                'key' => 'company_email',
                'value' => 'info@newscompany.com',
                'type' => 'text',
                'group' => 'company',
                'description' => 'البريد الإلكتروني للشركة'
            ],
            [
                'key' => 'company_latitude',
                'value' => '30.0444',
                'type' => 'float',
                'group' => 'company',
                'description' => 'خط العرض (Latitude)'
            ],
            [
                'key' => 'company_longitude',
                'value' => '31.2357',
                'type' => 'float',
                'group' => 'company',
                'description' => 'خط الطول (Longitude)'
            ],

            // SEO Settings
            [
                'key' => 'sitemap_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'seo',
                'description' => 'تفعيل خريطة الموقع'
            ],
            [
                'key' => 'sitemap_news_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'seo',
                'description' => 'تضمين الأخبار في الخريطة'
            ],
            [
                'key' => 'sitemap_categories_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'seo',
                'description' => 'تضمين الفئات في الخريطة'
            ],
            [
                'key' => 'sitemap_frequency',
                'value' => 'daily',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'تكرار تحديث الخريطة'
            ],
            [
                'key' => 'sitemap_priority',
                'value' => '0.8',
                'type' => 'float',
                'group' => 'seo',
                'description' => 'أولوية الصفحات في الخريطة'
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
