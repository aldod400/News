<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add default company info settings
        $defaultSettings = [
            'company_name' => '',
            'company_address' => '',
            'company_city' => '',
            'company_country' => '',
            'company_phone' => '',
            'company_email' => '',
            'company_latitude' => '',
            'company_longitude' => '',
        ];

        foreach ($defaultSettings as $key => $value) {
            // Only create if doesn't exist
            if (!SiteSetting::where('key', $key)->exists()) {
                SiteSetting::create([
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove company info settings
        $companyKeys = [
            'company_name',
            'company_address',
            'company_city',
            'company_country',
            'company_phone',
            'company_email',
            'company_latitude',
            'company_longitude',
        ];

        SiteSetting::whereIn('key', $companyKeys)->delete();
    }
};
