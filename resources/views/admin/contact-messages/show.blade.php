@extends('layouts.admin')

@section('title', 'عرض الرسالة')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-envelope"></i> عرض الرسالة
        </h1>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> العودة للقائمة
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- Message Details -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">تفاصيل الرسالة</h6>
                    <div>
                        @if(!$message->is_read)
                            <span class="badge badge-warning">جديد</span>
                        @elseif($message->is_replied)
                            <span class="badge badge-success">تم الرد</span>
                        @else
                            <span class="badge badge-info">مقروء</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>الاسم:</strong></div>
                        <div class="col-sm-9">{{ $message->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>البريد الإلكتروني:</strong></div>
                        <div class="col-sm-9">
                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                        </div>
                    </div>
                    
                    @if($message->phone)
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>رقم الهاتف:</strong></div>
                        <div class="col-sm-9">
                            <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>الموضوع:</strong></div>
                        <div class="col-sm-9">{{ $message->subject }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>تاريخ الإرسال:</strong></div>
                        <div class="col-sm-9">{{ $message->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <strong>الرسالة:</strong>
                        <div class="bg-light p-3 mt-2 rounded">
                            {!! nl2br(e($message->message)) !!}
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="mt-4">
                        <h6>إجراءات سريعة:</h6>
                        <div class="btn-group" role="group">
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                               class="btn btn-primary">
                                <i class="fas fa-reply"></i> الرد عبر البريد
                            </a>
                            
                            @if(!$message->is_replied)
                            <button type="button" class="btn btn-success mark-replied-btn" 
                                    data-id="{{ $message->id }}">
                                <i class="fas fa-check"></i> تعليم كمرد عليه
                            </button>
                            @endif
                            
                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if($message->admin_notes)
                    <!-- Admin Notes Display -->
                    <div class="mt-4">
                        <h6><i class="fas fa-sticky-note text-warning"></i> الملاحظات الإدارية:</h6>
                        <div class="bg-light p-3 rounded border-left-warning" style="border-left: 4px solid #ffc107!important;">
                            {!! nl2br(e($message->admin_notes)) !!}
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> آخر تحديث: {{ $message->updated_at->format('Y-m-d H:i') }}
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Admin Notes Editor -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit"></i> 
                        {{ $message->admin_notes ? 'تحديث الملاحظات' : 'إضافة ملاحظات' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contact-messages.update', $message->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="admin_notes">الملاحظات الإدارية:</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" 
                                      rows="6" placeholder="أضف ملاحظاتك الإدارية هنا...">{{ $message->admin_notes }}</textarea>
                            <small class="form-text text-muted">ستظهر هذه الملاحظات تحت تفاصيل الرسالة</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> حفظ الملاحظات
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Mark as replied
    $('.mark-replied-btn').click(function() {
        let messageId = $(this).data('id');
        let button = $(this);
        
        $.ajax({
            url: '{{ url("admin/contact-messages") }}/' + messageId + '/mark-replied',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    });
});
</script>
@endsection
