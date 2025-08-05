<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyData = [
            'company_name' => 'شركة الأخبار الإلكترونية',
            'company_address' => 'شارع التحرير، المنطقة التجارية',
            'company_city' => 'القاهرة',
            'company_country' => 'مصر',
            'company_phone' => '+20-2-12345678',
            'company_email' => 'info@news-company.com',
            'company_latitude' => '30.0444',  // Cairo coordinates
            'company_longitude' => '31.2357',
        ];

        foreach ($companyData as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->command->info('Company information seeded successfully!');
    }
}
