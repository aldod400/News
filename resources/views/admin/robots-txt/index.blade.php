@extends('layouts.admin')

@section('title', 'إدارة Robots.txt')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">إدارة Robots.txt</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> إضافة جديد
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>المحتوى</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($robotsTxts as $robotsTxt)
                                    <tr class="{{ $robotsTxt->is_active ? 'table-success' : '' }}">
                                        <td>{{ $robotsTxt->id }}</td>
                                        <td>
                                            <pre style="max-height: 100px; overflow-y: auto; white-space: pre-wrap;">{{ Str::limit($robotsTxt->content, 200) }}</pre>
                                        </td>
                                        <td>
                                            @if($robotsTxt->is_active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ $robotsTxt->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                @if(!$robotsTxt->is_active)
                                                    <form action="{{ route('admin.robots-txt.set-active', $robotsTxt) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" title="تفعيل">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editModal{{ $robotsTxt->id }}"
                                                        title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                @if(!$robotsTxt->is_active)
                                                    <form action="{{ route('admin.robots-txt.destroy', $robotsTxt) }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $robotsTxt->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل Robots.txt</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.robots-txt.update', $robotsTxt) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="content{{ $robotsTxt->id }}" class="form-label">محتوى Robots.txt</label>
                                                            <textarea class="form-control" id="content{{ $robotsTxt->id }}" name="content" rows="15" required>{{ $robotsTxt->content }}</textarea>
                                                            <div class="form-text">يمكنك استخدام قواعد robots.txt المعيارية</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">لا توجد محتويات robots.txt</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Current Active Robots.txt Preview -->
            @if($activeRobotsTxt)
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Robots.txt الحالي النشط</h4>
                    </div>
                    <div class="card-body">
                        <pre style="background-color: #f8f9fa; padding: 15px; border-radius: 5px;">{{ $activeRobotsTxt->content }}</pre>
                        <p class="text-muted">
                            <small>آخر تحديث: {{ $activeRobotsTxt->updated_at->format('Y-m-d H:i:s') }}</small>
                        </p>
                        <a href="{{ url('/robots.txt') }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i> عرض Robots.txt المباشر
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة Robots.txt جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.robots-txt.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newContent" class="form-label">محتوى Robots.txt</label>
                        <textarea class="form-control" id="newContent" name="content" rows="15" required>User-agent: *
Disallow: /admin/
Disallow: /dashboard/
Disallow: /profile/
Disallow: /login/
Disallow: /register/

# Allow all other pages
Allow: /

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}</textarea>
                        <div class="form-text">يمكنك تعديل هذا المحتوى حسب احتياجاتك</div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6>أمثلة على قواعد robots.txt:</h6>
                        <ul class="mb-0">
                            <li><code>User-agent: *</code> - ينطبق على جميع محركات البحث</li>
                            <li><code>Disallow: /admin/</code> - منع الدخول لمجلد admin</li>
                            <li><code>Allow: /</code> - السماح بالدخول لجميع الصفحات الأخرى</li>
                            <li><code>Sitemap: {{ url('/sitemap.xml') }}</code> - رابط خريطة الموقع</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
