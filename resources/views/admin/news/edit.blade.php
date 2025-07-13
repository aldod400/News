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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#editNewsForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let submitBtn = $('#submitBtn');
                let originalText = submitBtn.html();

                // Disable button and show loading
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors || {};
                        let errorMessage = 'Please check the form and try again.';
                        
                        if (Object.keys(errors).length > 0) {
                            errorMessage = Object.values(errors).flat().join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error!',
                            text: errorMessage
                        });
                    },
                    complete: function() {
                        // Re-enable button
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@endsection
