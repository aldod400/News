<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUs;
use App\Models\EditorialBoard;
use App\Models\Office;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create About Us description
        AboutUs::updateOrCreate(
            ['id' => 1],
            [
                'description' => [
                    'en' => '<p>Welcome to our news organization. We are dedicated to providing accurate, timely, and comprehensive news coverage to our readers. Our mission is to inform, educate, and empower our community through quality journalism.</p><p>Founded with the vision of creating a trusted source of information, we strive to maintain the highest standards of journalistic integrity. Our team of experienced reporters and editors work tirelessly to bring you the most important stories from around the world.</p>',
                    'ar' => '<p>مرحباً بكم في مؤسستنا الإخبارية. نحن ملتزمون بتقديم تغطية إخبارية دقيقة وشاملة وفي الوقت المناسب لقرائنا. مهمتنا هي إعلام وتثقيف وتمكين مجتمعنا من خلال الصحافة عالية الجودة.</p><p>تأسست برؤية إنشاء مصدر موثوق للمعلومات، ونسعى للحفاظ على أعلى معايير النزاهة الصحفية. يعمل فريقنا من المراسلين والمحررين ذوي الخبرة بلا كلل لتقديم أهم القصص من حول العالم.</p>'
                ]
            ]
        );

        // Create Editorial Board members
        $editorialMembers = [
            [
                'name' => [
                    'en' => 'Ahmed Hassan',
                    'ar' => 'أحمد حسن'
                ],
                'position' => [
                    'en' => 'Editor-in-Chief',
                    'ar' => 'رئيس التحرير'
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Sarah Johnson',
                    'ar' => 'سارة جونسون'
                ],
                'position' => [
                    'en' => 'Deputy Editor',
                    'ar' => 'نائب رئيس التحرير'
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Mohamed Ali',
                    'ar' => 'محمد علي'
                ],
                'position' => [
                    'en' => 'News Director',
                    'ar' => 'مدير الأخبار'
                ],
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($editorialMembers as $member) {
            EditorialBoard::create($member);
        }

        // Create Offices
        $offices = [
            [
                'name' => [
                    'en' => 'Main Office - Cairo',
                    'ar' => 'المكتب الرئيسي - القاهرة'
                ],
                'address' => [
                    'en' => 'Downtown Cairo, Egypt',
                    'ar' => 'وسط البلد، القاهرة، مصر'
                ],
                'phone' => '+20 2 1234 5678',
                'email' => 'cairo@newssite.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Alexandria Branch',
                    'ar' => 'فرع الإسكندرية'
                ],
                'address' => [
                    'en' => 'Alexandria, Egypt',
                    'ar' => 'الإسكندرية، مصر'
                ],
                'phone' => '+20 3 1234 5678',
                'email' => 'alexandria@newssite.com',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
