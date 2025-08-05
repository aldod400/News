<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdvisoryBoard;

class AdvisoryBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => [
                    'en' => 'Dr. Ahmed Mahmoud',
                    'ar' => 'د. أحمد محمود'
                ],
                'job_title' => [
                    'en' => 'Chairman of Advisory Board',
                    'ar' => 'رئيس المجلس الاستشاري'
                ],
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => [
                    'en' => 'Prof. Sarah Johnson',
                    'ar' => 'البروفيسورة سارة جونسون'
                ],
                'job_title' => [
                    'en' => 'Media & Communications Advisor',
                    'ar' => 'مستشارة الإعلام والاتصالات'
                ],
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => [
                    'en' => 'Dr. Mohamed Al-Rashid',
                    'ar' => 'د. محمد الراشد'
                ],
                'job_title' => [
                    'en' => 'Technology & Innovation Advisor',
                    'ar' => 'مستشار التكنولوجيا والابتكار'
                ],
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => [
                    'en' => 'Ms. Fatima Al-Zahra',
                    'ar' => 'الأستاذة فاطمة الزهراء'
                ],
                'job_title' => [
                    'en' => 'Legal Affairs Advisor',
                    'ar' => 'مستشارة الشؤون القانونية'
                ],
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => [
                    'en' => 'Dr. Omar Hassan',
                    'ar' => 'د. عمر حسان'
                ],
                'job_title' => [
                    'en' => 'Strategic Planning Advisor',
                    'ar' => 'مستشار التخطيط الاستراتيجي'
                ],
                'order' => 5,
                'is_active' => true
            ],
            [
                'name' => [
                    'en' => 'Prof. Layla Abdel Rahman',
                    'ar' => 'البروفيسورة ليلى عبد الرحمن'
                ],
                'job_title' => [
                    'en' => 'Research & Development Advisor',
                    'ar' => 'مستشارة البحث والتطوير'
                ],
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($members as $member) {
            AdvisoryBoard::create($member);
        }
    }
}
