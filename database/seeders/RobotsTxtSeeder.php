<?php

namespace Database\Seeders;

use App\Models\RobotsTxt;
use Illuminate\Database\Seeder;

class RobotsTxtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RobotsTxt::create([
            'content' => "User-agent: *\nDisallow: /admin/\nDisallow: /dashboard/\nDisallow: /profile/\nDisallow: /login/\nDisallow: /register/\n\n# Allow all other pages\nAllow: /\n\n# Sitemap\nSitemap: " . url('/sitemap.xml'),
            'is_active' => true
        ]);
    }
}
