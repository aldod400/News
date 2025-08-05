<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\AdvisoryBoard;

class SetupAdvisoryBoard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:advisory-board';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Advisory Board system - create tables and sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up Advisory Board system...');

        try {
            // Check if table exists
            if (!Schema::hasTable('advisory_board')) {
                $this->info('Creating advisory_board table...');
                
                // Create table
                DB::statement("
                    CREATE TABLE IF NOT EXISTS `advisory_board` (
                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                      `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
                      `job_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`job_title`)),
                      `image` varchar(255) DEFAULT NULL,
                      `order` int(11) NOT NULL DEFAULT 0,
                      `is_active` tinyint(1) NOT NULL DEFAULT 1,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                ");
                
                $this->info('✓ Advisory board table created successfully');
            } else {
                $this->info('✓ Advisory board table already exists');
            }

            // Check if data exists
            $existingCount = AdvisoryBoard::count();
            if ($existingCount == 0) {
                $this->info('Adding sample advisory board members...');
                
                $members = [
                    [
                        'name' => json_encode([
                            'en' => 'Dr. Ahmed Mahmoud',
                            'ar' => 'د. أحمد محمود'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Chairman of Advisory Board',
                            'ar' => 'رئيس المجلس الاستشاري'
                        ]),
                        'order' => 1,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'name' => json_encode([
                            'en' => 'Prof. Sarah Johnson',
                            'ar' => 'البروفيسورة سارة جونسون'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Media & Communications Advisor',
                            'ar' => 'مستشارة الإعلام والاتصالات'
                        ]),
                        'order' => 2,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'name' => json_encode([
                            'en' => 'Dr. Mohamed Al-Rashid',
                            'ar' => 'د. محمد الراشد'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Technology & Innovation Advisor',
                            'ar' => 'مستشار التكنولوجيا والابتكار'
                        ]),
                        'order' => 3,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'name' => json_encode([
                            'en' => 'Ms. Fatima Al-Zahra',
                            'ar' => 'الأستاذة فاطمة الزهراء'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Legal Affairs Advisor',
                            'ar' => 'مستشارة الشؤون القانونية'
                        ]),
                        'order' => 4,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'name' => json_encode([
                            'en' => 'Dr. Omar Hassan',
                            'ar' => 'د. عمر حسان'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Strategic Planning Advisor',
                            'ar' => 'مستشار التخطيط الاستراتيجي'
                        ]),
                        'order' => 5,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                    [
                        'name' => json_encode([
                            'en' => 'Prof. Layla Abdel Rahman',
                            'ar' => 'البروفيسورة ليلى عبد الرحمن'
                        ]),
                        'job_title' => json_encode([
                            'en' => 'Research & Development Advisor',
                            'ar' => 'مستشارة البحث والتطوير'
                        ]),
                        'order' => 6,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                ];

                foreach ($members as $member) {
                    DB::table('advisory_board')->insert($member);
                }
                
                $this->info('✓ Sample advisory board members added successfully');
            } else {
                $this->info("✓ Advisory board data already exists ({$existingCount} members)");
            }

            $this->newLine();
            $this->info('🎉 Advisory Board system setup completed successfully!');
            $this->info('You can now access:');
            $this->info('📄 Public page: /advisory-board');
            $this->info('⚙️  Admin panel: /admin/advisory-board');
            $this->newLine();

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error('Please check your database connection and try again.');
            return 1;
        }

        return 0;
    }
}
