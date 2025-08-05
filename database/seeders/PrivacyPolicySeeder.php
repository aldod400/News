<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::create([
            'title' => [
                'en' => 'Privacy Policy',
                'ar' => 'سياسة الخصوصية'
            ],
            'content' => [
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

<h2>Information Sharing</h2>

<p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except in the following circumstances:</p>

<ul>
<li>When required by law or legal process</li>
<li>To protect our rights and property</li>
<li>With service providers who assist us in operating our website</li>
</ul>

<h2>Data Security</h2>

<p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>

<h2>Your Rights</h2>

<p>You have the right to:</p>

<ul>
<li>Access your personal information</li>
<li>Correct any inaccurate information</li>
<li>Request deletion of your information</li>
<li>Opt-out of marketing communications</li>
</ul>

<h2>Cookies Policy</h2>

<p>Our website uses cookies to enhance your browsing experience. You can choose to disable cookies through your browser settings, though this may affect website functionality.</p>

<h2>Changes to This Policy</h2>

<p>We may update this privacy policy from time to time. Any changes will be posted on this page with an updated revision date.</p>

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

<h2>مشاركة المعلومات</h2>

<p>لا نبيع أو نتاجر أو ننقل معلوماتك الشخصية إلى أطراف ثالثة دون موافقتك، باستثناء الظروف التالية:</p>

<ul>
<li>عندما يتطلب القانون أو الإجراءات القانونية ذلك</li>
<li>لحماية حقوقنا وممتلكاتنا</li>
<li>مع مقدمي الخدمات الذين يساعدوننا في تشغيل موقعنا</li>
</ul>

<h2>أمان البيانات</h2>

<p>نطبق تدابير أمنية مناسبة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو التعديل أو الكشف أو التدمير.</p>

<h2>حقوقك</h2>

<p>لديك الحق في:</p>

<ul>
<li>الوصول إلى معلوماتك الشخصية</li>
<li>تصحيح أي معلومات غير دقيقة</li>
<li>طلب حذف معلوماتك</li>
<li>إلغاء الاشتراك في الاتصالات التسويقية</li>
</ul>

<h2>سياسة ملفات تعريف الارتباط</h2>

<p>يستخدم موقعنا ملفات تعريف الارتباط لتحسين تجربة التصفح. يمكنك اختيار تعطيل ملفات تعريف الارتباط من خلال إعدادات المتصفح، رغم أن هذا قد يؤثر على وظائف الموقع.</p>

<h2>التغييرات على هذه السياسة</h2>

<p>قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر. سيتم نشر أي تغييرات على هذه الصفحة مع تاريخ المراجعة المحدث.</p>

<h2>اتصل بنا</h2>

<p>إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى الاتصال بنا من خلال صفحة الاتصال أو مراسلتنا مباشرة عبر البريد الإلكتروني.</p>'
            ],
            'last_updated' => now(),
            'is_active' => true
        ]);
    }
}
