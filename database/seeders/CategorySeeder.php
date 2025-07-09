<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'أخبار عامة', 'views' => rand(100, 1000)],
            ['name' => 'تكنولوجيا', 'views' => rand(150, 800)],
            ['name' => 'رياضة', 'views' => rand(200, 1200)],
            ['name' => 'صحة', 'views' => rand(120, 600)],
            ['name' => 'اقتصاد', 'views' => rand(80, 500)],
            ['name' => 'سياسة', 'views' => rand(300, 1500)],
            ['name' => 'ثقافة وفنون', 'views' => rand(90, 400)],
            ['name' => 'علوم', 'views' => rand(110, 700)],
            ['name' => 'سفر وسياحة', 'views' => rand(70, 350)],
            ['name' => 'طبخ', 'views' => rand(160, 900)],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
