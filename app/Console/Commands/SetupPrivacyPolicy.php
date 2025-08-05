<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PrivacyPolicy;

class SetupPrivacyPolicy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:privacy-policy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Privacy Policy system - create tables and sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up Privacy Policy system...');

        try {
            // Check if table exists
            if (!Schema::hasTable('privacy_policy')) {
                $this->info('Creating privacy_policy table...');
                
                // Create table
                DB::statement("
                    CREATE TABLE IF NOT EXISTS `privacy_policy` (
                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                      `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
                      `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
                      `last_updated` timestamp NULL DEFAULT NULL,
                      `is_active` tinyint(1) NOT NULL DEFAULT 1,
                      `created_at` timestamp NULL DEFAULT NULL,
                      `updated_at` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                ");
                
                $this->info('✓ Privacy policy table created successfully');
            } else {
                $this->info('✓ Privacy policy table already exists');
            }

            // Check if data exists
            $existingCount = PrivacyPolicy::count();
            if ($existingCount == 0) {
                $this->info('Adding sample privacy policy...');
                
                $policyData = [
                    'title' => json_encode([
                        'en' => 'Privacy Policy',
                        'ar' => 'سياسة الخصوصية'
                    ]),
                    'content' => json_encode([
                        'en' => '<h1>Privacy Policy</h1>

<p>Your privacy is important to us. This privacy policy explains how we collect, use, and protect your information when you visit our website.</p>

<h2>Information We Collect</h2>

<p>We may collect the following types of information:</p>

<ul>
<li><strong>Personal Information:</strong> Name, email address, phone number, and other contact details when you voluntarily provide them.</li>
<li><strong>Usage Data:</strong> Information about how you use our website, including pages visited, time spent, and other analytics data.</li>
<li><strong>Cookies:</strong> Small files stored on your device to improve your browsing experience.</li>
</ul>

<h2>How We Use Your Information</h2>

<p>We use your information for the following purposes:</p>

<ul>
<li>To provide and maintain our services</li>
<li>To improve our website and user experience</li>
<li>To communicate with you about updates and news</li>
<li>To respond to your inquiries and provide customer support</li>
<li>To comply with legal obligations</li>
</ul>

<h2>Contact Us</h2>

<p>If you have any questions about this privacy policy, please contact us through our contact page or email us directly.</p>',

                        'ar' => '<h1>سياسة الخصوصية</h1>

<p>خصوصيتك مهمة بالنسبة لنا. توضح سياسة الخصوصية هذه كيفية جمع واستخدام وحماية معلوماتك عند زيارة موقعنا الإلكتروني.</p>

<h2>المعلومات التي نجمعها</h2>

<p>قد نجمع الأنواع التالية من المعلومات:</p>

<ul>
<li><strong>المعلومات الشخصية:</strong> الاسم وعنوان البريد الإلكتروني ورقم الهاتف وتفاصيل الاتصال الأخرى عندما تقدمها طوعياً.</li>
<li><strong>بيانات الاستخدام:</strong> معلومات حول كيفية استخدامك لموقعنا، بما في ذلك الصفحات التي تمت زيارتها والوقت المستغرق وبيانات التحليل الأخرى.</li>
<li><strong>ملفات تعريف الارتباط:</strong> ملفات صغيرة مخزنة على جهازك لتحسين تجربة التصفح.</li>
</ul>

<h2>كيف نستخدم معلوماتك</h2>

<p>نستخدم معلوماتك للأغراض التالية:</p>

<ul>
<li>لتقديم خدماتنا والحفاظ عليها</li>
<li>لتحسين موقعنا وتجربة المستخدم</li>
<li>للتواصل معك حول التحديثات والأخبار</li>
<li>للرد على استفساراتك وتقديم دعم العملاء</li>
<li>للامتثال للالتزامات القانونية</li>
</ul>

<h2>اتصل بنا</h2>

<p>إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى الاتصال بنا من خلال صفحة الاتصال أو مراسلتنا مباشرة عبر البريد الإلكتروني.</p>'
                    ]),
                    'last_updated' => now(),
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                DB::table('privacy_policy')->insert($policyData);
                
                $this->info('✓ Sample privacy policy added successfully');
            } else {
                $this->info("✓ Privacy policy data already exists ({$existingCount} policies)");
            }

            $this->newLine();
            $this->info('🎉 Privacy Policy system setup completed successfully!');
            $this->info('You can now access:');
            $this->info('📄 Public page: /privacy-policy');
            $this->info('⚙️  Admin panel: /admin/privacy-policy');
            $this->newLine();

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error('Please check your database connection and try again.');
            return 1;
        }

        return 0;
    }
}
