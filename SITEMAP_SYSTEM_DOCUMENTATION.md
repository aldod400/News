# نظام إدارة Sitemap الديناميكي وإعدادات الموقع

## نظرة عامة
تم إضافة نظام متكامل لإدارة خريطة الموقع (Sitemap) بشكل ديناميكي مع إعدادات شاملة للموقع والشركة. هذا النظام يولد sitemap.xml تلقائياً ويتضمن معلومات الشركة والموقع الجغرافي.

## الميزات الجديدة

### 1. إدارة إعدادات الموقع
- **إعدادات عامة**: اسم الموقع، الرابط الأساسي
- **معلومات الشركة**: الاسم، العنوان، المدينة، الدولة، الهاتف، البريد الإلكتروني
- **الموقع الجغرافي**: خط العرض والطول للموقع على الخريطة
- **إعدادات SEO**: تحكم في Sitemap وتكرار التحديث

### 2. Sitemap ديناميكي
- **توليد تلقائي**: sitemap.xml يتم توليده تلقائياً من قاعدة البيانات
- **تضمين الأخبار**: جميع الأخبار المنشورة مع Google News format
- **تضمين الفئات**: فئات الأخبار مع الأولويات المناسبة
- **SEO محسن**: بيانات structured مع Schema.org

### 3. تكامل مع Robots.txt
- **تحديث تلقائي**: رابط Sitemap يُضاف لـ robots.txt تلقائياً
- **تزامن البيانات**: عند تغيير إعدادات الموقع، يتم تحديث robots.txt

### 4. واجهة إدارة متقدمة
- **Tabs منظمة**: إعدادات عامة، معلومات الشركة، إعدادات SEO
- **معاينة مباشرة**: عرض Sitemap وإحصائيات فورية
- **Dashboard widgets**: عرض حالة النظام في لوحة التحكم

## الملفات المضافة

### Models & Controllers
```
App\Models\SiteSetting          - Model إعدادات الموقع
App\Http\Controllers\SiteSettingsController  - إدارة الإعدادات
App\Http\Controllers\SitemapController       - توليد Sitemap
```

### Views
```
resources\views\admin\site-settings\index.blade.php - صفحة الإدارة
```

### Database
```
database\migrations\2025_01_21_000000_create_site_settings_table.php
database\seeders\SiteSettingsSeeder.php
database\factories\SiteSettingFactory.php
```

### Helpers
```
app\Helpers\SitemapHelper.php      - دوال مساعدة للـ Sitemap
app\Helpers\RobotsTxtHelper.php    - دوال مساعدة للـ Robots.txt
```

## Routes الجديدة

### عامة
```
GET  /sitemap.xml                     - عرض خريطة الموقع
```

### إدارية (Super Admin فقط)
```
GET  /admin/site-settings             - صفحة إدارة الإعدادات
PUT  /admin/site-settings             - تحديث الإعدادات
```

## Helper Functions الجديدة

### إعدادات الموقع
```php
get_site_setting($key, $default)     - الحصول على إعداد
get_company_info()                    - معلومات الشركة كاملة
get_sitemap_url()                     - رابط خريطة الموقع
```

### Schema.org & SEO
```php
generate_organization_schema()        - schema للشركة
generate_location_schema()           - schema للموقع الجغرافي
get_sitemap_stats()                  - إحصائيات خريطة الموقع
```

## كيفية الاستخدام

### 1. الوصول للإدارة
```
/admin/site-settings
```

### 2. إعداد معلومات الشركة
1. انتقل لتبويب "معلومات الشركة"
2. أدخل اسم الشركة والعنوان
3. حدد الموقع الجغرافي (خط العرض والطول)
4. أضف معلومات الاتصال

### 3. إعدادات SEO
1. انتقل لتبويب "إعدادات SEO"
2. فعل/ألغي تفعيل Sitemap
3. اختر المحتوى المُضمن (أخبار، فئات)
4. حدد تكرار التحديث والأولوية

### 4. معاينة النتائج
- تبويب "معاينة Sitemap" لعرض الإحصائيات
- `/sitemap.xml` للعرض المباشر
- Dashboard widgets للمراقبة المستمرة

## مثال على Sitemap المُولد

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
  <url>
    <loc>https://example.com/</loc>
    <lastmod>2025-01-21T12:00:00Z</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  
  <url>
    <loc>https://example.com/news/breaking-news</loc>
    <lastmod>2025-01-21T10:30:00Z</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
    <news:news>
      <news:publication>
        <news:name>شركة الأخبار المحدودة</news:name>
        <news:language>ar</news:language>
      </news:publication>
      <news:publication_date>2025-01-21T10:30:00Z</news:publication_date>
      <news:title>أخبار عاجلة</news:title>
    </news:news>
  </url>
</urlset>
```

## Google Search Console التكامل
- رفع sitemap.xml لـ Google Search Console
- تتبع فهرسة الصفحات
- تحليل أداء SEO

## الفوائد SEO

### 1. Google News
- تنسيق مخصص للأخبار
- فهرسة أسرع للمحتوى الجديد
- ظهور في Google News

### 2. Local SEO
- Schema.org للموقع الجغرافي
- تحسين الظهور في البحث المحلي
- خرائط جوجل integration

### 3. Technical SEO
- Sitemap محدث تلقائياً
- URLs منتظمة ومفهومة
- أولويات صحيحة للصفحات

## الصيانة والتطوير المستقبلي
- مراقبة حجم Sitemap (حد 50,000 URL)
- إضافة sitemap index للمواقع الكبيرة
- تحسين caching للأداء
- تكامل مع Analytics APIs
