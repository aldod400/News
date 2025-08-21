@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ __('general.news') }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.news.manage') }}">{{ __('general.news') }}</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>{{ __('admin.edit') }}</a>
                    </li>
                </ul>
            </div>
            {{-- Content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit News</h4>
                                <a href="{{ route('admin.news.manage') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Manage
                                </a>
                            </div>
                        </div>
                        
                        {{-- Flash Messages --}}
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
                        
                        <div class="card-body">
                            <form id="editNewsForm" method="POST" action="{{ route('admin.news.update', $news->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter news title" value="{{ old('title', $news->title) }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-select" id="category" name="category_id" required>
                                                <option value="">Choose Category</option>
                                                @foreach ($allCategory as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sub_category">Sub Category (Optional)</label>
                                            <select class="form-select" id="sub_category" name="sub_category_id">
                                                <option value="">Choose Sub Category</option>
                                                @if($news->subCategory)
                                                    <option value="{{ $news->subCategory->id }}" selected>
                                                        {{ $news->subCategory->name }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="Pending" {{ old('status', $news->status) == 'Pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="Accept" {{ old('status', $news->status) == 'Accept' ? 'selected' : '' }}>
                                                    Accept
                                                </option>
                                                <option value="Reject" {{ old('status', $news->status) == 'Reject' ? 'selected' : '' }}>
                                                    Reject
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                accept="image/*" />
                                            @if ($news->image)
                                                <small class="form-text text-muted">
                                                    Current image: {{ $news->image }}
                                                </small>
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/images/' . $news->image) }}" 
                                                         alt="Current Image" 
                                                         style="max-width: 100px; max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="10"
                                        placeholder="Enter news content" required>{{ old('content', $news->content) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submitBtn" class="btn btn-success">
                                        <i class="fa fa-save"></i> Update News
                                    </button>
                                    <a href="{{ route('admin.news.manage') }}" class="btn btn-secondary">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script>
        console.log('Script loaded');
        console.log('jQuery available:', typeof $ !== 'undefined');
        
        $(document).ready(function() {
            console.log('Document ready');
            console.log('Form element exists:', $('#editNewsForm').length > 0);
            
            if ($('#editNewsForm').length === 0) {
                console.error('Form not found!');
                return;
            }
            
            $('#editNewsForm').on('submit', function(e) {
                console.log('Form submit intercepted');
                e.preventDefault();

                let formData = new FormData(this);
                let submitBtn = $('#submitBtn');
                let originalText = submitBtn.html();

                // Disable button and show loading
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> جاري التحديث...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Show success message using SweetAlert2
                            Swal.fire({
                                title: 'نجح!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'موافق'
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            Swal.fire({
                                title: 'خطأ!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'موافق'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'حدث خطأ أثناء التحديث. يرجى المحاولة مرة أخرى.';
                        
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join('\n');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'خطأ!',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'موافق'
                        });
                    },
                    complete: function() {
                        // Re-enable button
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
        
        // Handle category change to load sub categories
        $('#category').change(function() {
            const categoryId = $(this).val();
            const subCategorySelect = $('#sub_category');
            
            // Clear existing options except for the empty one
            subCategorySelect.html('<option value="">Choose Sub Category</option>');
            
            if (categoryId) {
                $.ajax({
                    url: '/api/subcategories/' + categoryId,
                    method: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, subCategory) {
                                subCategorySelect.append(
                                    '<option value="' + subCategory.id + '">' + 
                                    subCategory.name + '</option>'
                                );
                            });
                        }
                    },
                    error: function() {
                        console.log('Error loading sub categories');
                    }
                });
            }
        });
        
        // Load sub categories on page load if category is already selected
        $(document).ready(function() {
            const categoryId = $('#category').val();
            const currentSubCategoryId = {{ $news->sub_category_id ?? 'null' }};
            
            if (categoryId) {
                $.ajax({
                    url: '/api/subcategories/' + categoryId,
                    method: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, subCategory) {
                                const selected = subCategory.id == currentSubCategoryId ? 'selected' : '';
                                $('#sub_category').append(
                                    '<option value="' + subCategory.id + '" ' + selected + '>' + 
                                    subCategory.name + '</option>'
                                );
                            });
                        }
                    }
                });
            }
        });
    });
    </script>
@endsection
