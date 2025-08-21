@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Sub Category</h3>
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
                        <a href="{{ route('admin.subcategory.manage') }}">Sub Category</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Create</a>
                    </li>
                </ul>
            </div>

            {{-- Content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Create Sub Category</h4>
                                <a href="{{ route('admin.subcategory.manage') }}" class="btn btn-secondary btn-round ms-auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back to Manage
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.subcategory.store') }}" method="POST" id="subcategoryForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent_category_id">Parent Category <span class="text-danger">*</span></label>
                                            <select class="form-control" id="parent_category_id" name="parent_category_id" required>
                                                <option value="">Select Parent Category</option>
                                                @foreach($allCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sub Category Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" 
                                                   placeholder="Enter sub category name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Save Sub Category
                                            </button>
                                            <a href="{{ route('admin.subcategory.manage') }}" class="btn btn-secondary">
                                                <i class="fa fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    </div>
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
        // Handle form submission with AJAX
        $('#subcategoryForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        swal("Success!", response.message, "success").then(() => {
                            window.location.href = response.redirect_url;
                        });
                    } else {
                        swal("Error!", response.message, "error");
                        submitButton.prop('disabled', false).html('<i class="fa fa-save"></i> Save Sub Category');
                    }
                },
                error: function(xhr) {
                    let message = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    swal("Error!", message, "error");
                    submitButton.prop('disabled', false).html('<i class="fa fa-save"></i> Save Sub Category');
                }
            });
        });
    </script>
@endsection
