<?php
// Quick setup script for About Us tables

// Load Laravel environment
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Get database connection
    $db = \Illuminate\Support\Facades\DB::connection();
    
    echo "Setting up About Us tables...\n";
    
    // Create about_us table
    $db->statement("
        CREATE TABLE IF NOT EXISTS `about_us` (
          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✓ about_us table created\n";
    
    // Create editorial_board table
    $db->statement("
        CREATE TABLE IF NOT EXISTS `editorial_board` (
          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
          `position` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`position`)),
          `image` varchar(255) DEFAULT NULL,
          `order` int(11) NOT NULL DEFAULT 0,
          `is_active` tinyint(1) NOT NULL DEFAULT 1,
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✓ editorial_board table created\n";
    
    // Create offices table
    $db->statement("
        CREATE TABLE IF NOT EXISTS `offices` (
          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
          `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`address`)),
          `phone` varchar(255) DEFAULT NULL,
          `email` varchar(255) DEFAULT NULL,
          `image` varchar(255) DEFAULT NULL,
          `order` int(11) NOT NULL DEFAULT 0,
          `is_active` tinyint(1) NOT NULL DEFAULT 1,
          `created_at` timestamp NULL DEFAULT NULL,
          `updated_at` timestamp NULL DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✓ offices table created\n";
    
    // Check if data already exists
    $aboutUsCount = $db->table('about_us')->count();
    if ($aboutUsCount == 0) {
        // Insert sample data
        $db->table('about_us')->insert([
            'description' => json_encode([
                'en' => '<p>Welcome to our news organization. We are dedicated to providing accurate, timely, and comprehensive news coverage to our readers. Our mission is to inform, educate, and empower our community through quality journalism.</p><p>Founded with the vision of creating a trusted source of information, we strive to maintain the highest standards of journalistic integrity. Our team of experienced reporters and editors work tirelessly to bring you the most important stories from around the world.</p>',
                'ar' => '<p>مرحباً بكم في مؤسستنا الإخبارية. نحن ملتزمون بتقديم تغطية إخبارية دقيقة وشاملة وفي الوقت المناسب لقرائنا. مهمتنا هي إعلام وتثقيف وتمكين مجتمعنا من خلال الصحافة عالية الجودة.</p><p>تأسست برؤية إنشاء مصدر موثوق للمعلومات، ونسعى للحفاظ على أعلى معايير النزاهة الصحفية. يعمل فريقنا من المراسلين والمحررين ذوي الخبرة بلا كلل لتقديم أهم القصص من حول العالم.</p>'
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        echo "✓ About Us content inserted\n";
        
        // Insert editorial board members
        $members = [
            ['name' => json_encode(['en' => 'Ahmed Hassan', 'ar' => 'أحمد حسن']), 'position' => json_encode(['en' => 'Editor-in-Chief', 'ar' => 'رئيس التحرير']), 'order' => 1],
            ['name' => json_encode(['en' => 'Sarah Johnson', 'ar' => 'سارة جونسون']), 'position' => json_encode(['en' => 'Deputy Editor', 'ar' => 'نائب رئيس التحرير']), 'order' => 2],
            ['name' => json_encode(['en' => 'Mohamed Ali', 'ar' => 'محمد علي']), 'position' => json_encode(['en' => 'News Director', 'ar' => 'مدير الأخبار']), 'order' => 3]
        ];
        
        foreach ($members as $member) {
            $member['is_active'] = 1;
            $member['created_at'] = now();
            $member['updated_at'] = now();
            $db->table('editorial_board')->insert($member);
        }
        echo "✓ Editorial board members inserted\n";
        
        // Insert offices
        $offices = [
            ['name' => json_encode(['en' => 'Main Office - Cairo', 'ar' => 'المكتب الرئيسي - القاهرة']), 'address' => json_encode(['en' => 'Downtown Cairo, Egypt', 'ar' => 'وسط البلد، القاهرة، مصر']), 'phone' => '+20 2 1234 5678', 'email' => 'cairo@newssite.com', 'order' => 1],
            ['name' => json_encode(['en' => 'Alexandria Branch', 'ar' => 'فرع الإسكندرية']), 'address' => json_encode(['en' => 'Alexandria, Egypt', 'ar' => 'الإسكندرية، مصر']), 'phone' => '+20 3 1234 5678', 'email' => 'alexandria@newssite.com', 'order' => 2]
        ];
        
        foreach ($offices as $office) {
            $office['is_active'] = 1;
            $office['created_at'] = now();
            $office['updated_at'] = now();
            $db->table('offices')->insert($office);
        }
        echo "✓ Offices inserted\n";
    } else {
        echo "✓ Data already exists, skipping insert\n";
    }
    
    echo "\n🎉 About Us system setup completed successfully!\n";
    echo "You can now access the About Us page at: /about-us\n";
    echo "Admin panel: /admin/about-us\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Please check your database connection and try again.\n";
}
