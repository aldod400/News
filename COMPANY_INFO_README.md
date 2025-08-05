# نظام إدارة معلومات الشركة والخرائط التفاعلية

## نظرة عامة

تم إضافة نظام متكامل لإدارة معلومات الشركة مع دعم الخرائط التفاعلية باستخدام Google Maps API. يتيح هذا النظام للمشرفين إدارة معلومات الشركة وتحديد موقعها على الخريطة، وعرض هذه المعلومات للزوار في الموقع.

## المميزات

### 1. لوحة التحكم (Admin Panel)
- **إدارة معلومات الشركة**: اسم الشركة، العنوان، المدينة، الدولة، الهاتف، البريد الإلكتروني
- **تحديد الموقع التفاعلي**: خريطة Google Maps لتحديد موقع الشركة
- **تحديث الإحداثيات التلقائي**: تحديث خط العرض والطول تلقائياً عند تحديد الموقع
- **البحث في العناوين**: إمكانية البحث عن العناوين والمواقع
- **واجهة سهلة الاستخدام**: تصميم عربي متجاوب

### 2. العرض في الموقع (Frontend)
- **صفحة اتصل بنا**: عرض كامل لمعلومات الشركة مع الخريطة
- **خريطة تفاعلية**: عرض موقع الشركة على خريطة Google Maps
- **روابط الاتجاهات**: رابط مباشر لخرائط جوجل للحصول على الاتجاهات
- **معلومات الاتصال**: عرض الهاتف والبريد الإلكتروني مع روابط مباشرة
- **تصميم متجاوب**: يعمل على جميع الأجهزة

## التثبيت والإعداد

### 1. الحصول على مفتاح Google Maps API

1. اذهب إلى [Google Cloud Console](https://console.cloud.google.com/)
2. أنشئ مشروع جديد أو اختر مشروع موجود
3. فعّل Maps JavaScript API و Places API
4. أنشئ مفتاح API جديد
5. قم بتقييد المفتاح للأمان (اختياري)

### 2. إعداد متغيرات البيئة

أضف مفتاح Google Maps API في ملف `.env`:

```bash
GOOGLE_MAPS_API_KEY=your_actual_google_maps_api_key_here
```

### 3. تشغيل Migration والـ Seeder

```bash
# تشغيل migrations
php artisan migrate

# إضافة بيانات تجريبية (اختياري)
php artisan db:seed --class=CompanyInfoSeeder

# تحديث Composer autoload
composer dump-autoload
```

## كيفية الاستخدام

### 1. إدارة معلومات الشركة

1. سجل الدخول كـ Super Admin
2. اذهب إلى **معلومات الشركة** من القائمة الجانبية
3. املأ معلومات الشركة الأساسية
4. انقر على الخريطة لتحديد موقع الشركة
5. احفظ التغييرات

### 2. عرض معلومات الشركة في الموقع

استخدم المكون المدمج في أي صفحة:

```blade
@include('components.company-info')
```

أو استخدم الدوال المساعدة:

```php
// معلومات الشركة
{{ getCompanyInfo('name') }}
{{ getCompanyInfo('address') }}
{{ getCompanyInfo('phone') }}
{{ getCompanyInfo('email') }}

// العنوان الكامل
{{ getCompanyFullAddress() }}

// التحقق من وجود موقع
@if(hasCompanyLocation())
    // عرض الخريطة
@endif

// الحصول على إحداثيات الموقع
@php $location = getCompanyLocation() @endphp

// رابط خرائط جوجل
<a href="{{ getGoogleMapsLink() }}">احصل على الاتجاهات</a>
```

## الملفات الرئيسية

### 1. Models
- `app/Models/SiteSetting.php` - نموذج إعدادات الموقع

### 2. Controllers
- `app/Http/Controllers/CompanyInfoController.php` - التحكم في معلومات الشركة

### 3. Views
- `resources/views/admin/company-info/index.blade.php` - واجهة إدارة معلومات الشركة
- `resources/views/components/company-info.blade.php` - مكون عرض معلومات الشركة
- `resources/views/contact.blade.php` - صفحة اتصل بنا

### 4. Helpers
- `app/Helpers/CompanyHelper.php` - دوال مساعدة لمعلومات الشركة

### 5. Routes
```php
// إدارة معلومات الشركة (Super Admin)
Route::prefix('admin/company-info')->name('admin.company-info.')->group(function () {
    Route::get('/', [CompanyInfoController::class, 'index'])->name('index');
    Route::put('/', [CompanyInfoController::class, 'update'])->name('update');
    Route::get('/api', [CompanyInfoController::class, 'getCompanyInfo'])->name('api');
});

// صفحة اتصل بنا
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
```

## API Endpoints

### الحصول على معلومات الشركة (JSON)
```
GET /admin/company-info/api
```

**Response:**
```json
{
    "success": true,
    "data": {
        "name": "شركة الأخبار الإلكترونية",
        "address": "شارع التحرير، المنطقة التجارية",
        "city": "القاهرة",
        "country": "مصر",
        "phone": "+20-2-12345678",
        "email": "info@news-company.com",
        "latitude": "30.0444",
        "longitude": "31.2357",
        "full_address": "شارع التحرير، المنطقة التجارية, القاهرة, مصر",
        "has_location": true
    }
}
```

## الدوال المساعدة المتاحة

```php
// الحصول على معلومة محددة
getCompanyInfo('name')           // اسم الشركة
getCompanyInfo('address')        // العنوان
getCompanyInfo('city')           // المدينة
getCompanyInfo('country')        // الدولة
getCompanyInfo('phone')          // الهاتف
getCompanyInfo('email')          // البريد الإلكتروني
getCompanyInfo('latitude')       // خط العرض
getCompanyInfo('longitude')      // خط الطول

// الحصول على جميع المعلومات
getCompanyInfo()                 // مصفوفة بجميع المعلومات

// العنوان الكامل
getCompanyFullAddress()          // "العنوان, المدينة, الدولة"

// التحقق من الموقع
hasCompanyLocation()             // true/false

// الحصول على الإحداثيات
getCompanyLocation()             // ['latitude' => float, 'longitude' => float]

// روابط الخرائط
getGoogleMapsLink()              // رابط خرائط جوجل
getGoogleMapsEmbedUrl($apiKey)   // رابط تضمين الخريطة
```

## التخصيص والتطوير

### إضافة حقول جديدة

1. أضف الحقل في Migration:
```php
SiteSetting::create(['key' => 'company_website', 'value' => '']);
```

2. أضف الحقل في Form:
```blade
<input type="url" name="settings[company_website]" 
       value="{{ \App\Models\SiteSetting::get('company_website', '') }}">
```

3. أضف التحقق في Controller:
```php
'settings.company_website' => 'nullable|url|max:255',
```

4. أضف للـ Helper:
```php
function getCompanyWebsite() {
    return \App\Models\SiteSetting::get('company_website', '');
}
```

### تخصيص التصميم

يمكن تخصيص CSS في:
- `resources/views/admin/company-info/index.blade.php` - واجهة الإدارة
- `resources/views/components/company-info.blade.php` - واجهة العرض
- `resources/views/contact.blade.php` - صفحة الاتصال

### إعدادات الخريطة

يمكن تخصيص Google Maps في JavaScript:
- تغيير الـ zoom level
- تخصيص أيقونة العلامة
- إضافة styles للخريطة
- تفعيل/إلغاء التحكمات

## الأمان والصلاحيات

- وصول Super Admin فقط لإدارة معلومات الشركة
- تحقق من صحة البيانات المدخلة
- تحقق من صحة الإحداثيات الجغرافية
- حماية من XSS و CSRF
- تقييد مفتاح Google Maps API (مُوصى به)

## استكشاف الأخطاء

### الخريطة لا تظهر
1. تأكد من صحة مفتاح Google Maps API
2. تأكد من تفعيل Maps JavaScript API
3. تحقق من console المتصفح للأخطاء

### البيانات لا تحفظ
1. تأكد من وجود جدول `site_settings`
2. تحقق من صلاحيات قاعدة البيانات
3. راجع logs الخطأ في `storage/logs/`

### الدوال المساعدة لا تعمل
1. شغل `composer dump-autoload`
2. تأكد من إضافة الـ Helper في `composer.json`
3. تحقق من وجود الـ Helper في مجلد `app/Helpers/`

## الدعم

للمزيد من المساعدة أو الإبلاغ عن الأخطاء، يرجى مراجعة:
- ملفات الـ logs في `storage/logs/`
- التوثيق الرسمي لـ Google Maps API
- توثيق Laravel للنماذج والـ Controllers
