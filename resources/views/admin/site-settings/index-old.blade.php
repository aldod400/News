@extends('layouts.admin')

@section('title', 'إعدادات الموقع')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog me-2"></i>
                        إعدادات الموقع والشركة
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.site-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- General Settings Tab -->
                        <div class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                            <a class="nav-link active" id="pills-general-tab" data-bs-toggle="pill" href="#pills-general" role="tab">
                                <i class="fas fa-globe"></i> إعدادات عامة
                            </a>
                            <a class="nav-link" id="pills-company-tab" data-bs-toggle="pill" href="#pills-company" role="tab">
                                <i class="fas fa-building"></i> معلومات الشركة
                            </a>
                            <a class="nav-link" id="pills-seo-tab" data-bs-toggle="pill" href="#pills-seo" role="tab">
                                <i class="fas fa-search"></i> إعدادات SEO
                            </a>
                            <a class="nav-link" id="pills-preview-tab" data-bs-toggle="pill" href="#pills-preview" role="tab">
                                <i class="fas fa-eye"></i> معاينة Sitemap
                            </a>
                        </div>

                        <div class="tab-content mt-4" id="pills-without-border-tabContent">
                            <!-- General Settings -->
                            <div class="tab-pane fade show active" id="pills-general" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site_name">اسم الموقع</label>
                                            <input type="text" class="form-control" id="site_name" name="settings[site_name]" 
                                                   value="{{ \App\Models\SiteSetting::get('site_name', 'News Website') }}">
                                            <small class="form-text text-muted">اسم الموقع الذي يظهر في العنوان</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="site_url">رابط الموقع</label>
                                            <input type="url" class="form-control" id="site_url" name="settings[site_url]" 
                                                   value="{{ \App\Models\SiteSetting::get('site_url', url('/')) }}">
                                            <small class="form-text text-muted">الرابط الأساسي للموقع</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Information -->
                            <div class="tab-pane fade" id="pills-company" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name">اسم الشركة</label>
                                            <input type="text" class="form-control" id="company_name" name="settings[company_name]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_name', '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="company_email" name="settings[company_email]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_email', '') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company_address">عنوان الشركة</label>
                                    <textarea class="form-control" id="company_address" name="settings[company_address]" rows="3">{{ \App\Models\SiteSetting::get('company_address', '') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_city">المدينة</label>
                                            <input type="text" class="form-control" id="company_city" name="settings[company_city]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_city', '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_country">الدولة</label>
                                            <input type="text" class="form-control" id="company_country" name="settings[company_country]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_country', '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company_phone">رقم الهاتف</label>
                                            <input type="text" class="form-control" id="company_phone" name="settings[company_phone]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_phone', '') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_latitude">خط العرض (Latitude)</label>
                                            <input type="number" step="any" class="form-control" id="company_latitude" name="settings[company_latitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_latitude', '') }}" placeholder="30.0444">
                                            <small class="form-text text-muted">لتحديد الموقع على الخريطة</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_longitude">خط الطول (Longitude)</label>
                                            <input type="number" step="any" class="form-control" id="company_longitude" name="settings[company_longitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_longitude', '') }}" placeholder="31.2357">
                                            <small class="form-text text-muted">لتحديد الموقع على الخريطة</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Settings -->
                            <div class="tab-pane fade" id="pills-seo" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="sitemap_enabled" name="settings[sitemap_enabled]" value="1"
                                                   {{ \App\Models\SiteSetting::get('sitemap_enabled', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sitemap_enabled">
                                                تفعيل خريطة الموقع (Sitemap)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="sitemap_news_enabled" name="settings[sitemap_news_enabled]" value="1"
                                                   {{ \App\Models\SiteSetting::get('sitemap_news_enabled', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sitemap_news_enabled">
                                                تضمين الأخبار في الخريطة
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="sitemap_categories_enabled" name="settings[sitemap_categories_enabled]" value="1"
                                                   {{ \App\Models\SiteSetting::get('sitemap_categories_enabled', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sitemap_categories_enabled">
                                                تضمين الفئات في الخريطة
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitemap_frequency">تكرار التحديث</label>
                                            <select class="form-control" id="sitemap_frequency" name="settings[sitemap_frequency]">
                                                <option value="always" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'always' ? 'selected' : '' }}>دائماً</option>
                                                <option value="hourly" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'hourly' ? 'selected' : '' }}>كل ساعة</option>
                                                <option value="daily" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'daily' ? 'selected' : '' }}>يومياً</option>
                                                <option value="weekly" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'weekly' ? 'selected' : '' }}>أسبوعياً</option>
                                                <option value="monthly" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'monthly' ? 'selected' : '' }}>شهرياً</option>
                                                <option value="yearly" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'yearly' ? 'selected' : '' }}>سنوياً</option>
                                                <option value="never" {{ \App\Models\SiteSetting::get('sitemap_frequency', 'daily') == 'never' ? 'selected' : '' }}>مطلقاً</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitemap_priority">أولوية الصفحات</label>
                                            <input type="number" step="0.1" min="0" max="1" class="form-control" id="sitemap_priority" name="settings[sitemap_priority]" 
                                                   value="{{ \App\Models\SiteSetting::get('sitemap_priority', '0.8') }}">
                                            <small class="form-text text-muted">من 0.0 إلى 1.0</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sitemap Preview -->
                            <div class="tab-pane fade" id="pills-preview" role="tabpanel">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle"></i> معاينة خريطة الموقع</h6>
                                    <p>يمكنك معاينة خريطة الموقع المُولدة تلقائياً والتحقق من صحتها.</p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>روابط مهمة</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>خريطة الموقع</span>
                                                        <a href="{{ url('/sitemap.xml') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-external-link-alt"></i> عرض
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Robots.txt</span>
                                                        <a href="{{ url('/robots.txt') }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-external-link-alt"></i> عرض
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>إحصائيات</h5>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $newsCount = \App\Models\News::where('status', 'accepted')->count();
                                                    $categoriesCount = \App\Models\Category::count();
                                                @endphp
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>الأخبار المنشورة</span>
                                                        <span class="badge bg-primary">{{ $newsCount }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>الفئات</span>
                                                        <span class="badge bg-secondary">{{ $categoriesCount }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>إجمالي الصفحات في Sitemap</span>
                                                        <span class="badge bg-success">{{ 1 + $newsCount + $categoriesCount }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ الإعدادات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-save functionality (optional)
    const form = document.querySelector('form');
    let saveTimeout;
    
    function autoSave() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            console.log('Auto-saving...');
            // You can implement auto-save here if needed
        }, 2000);
    }
    
    // Add change listeners to form inputs
    form.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('change', autoSave);
    });
});
</script>
@endsection
