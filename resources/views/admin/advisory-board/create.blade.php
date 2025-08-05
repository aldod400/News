@extends('layouts.admin')

@section('title', __('general.add_advisory_board_member'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('general.add_advisory_board_member') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.advisory-board.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('general.back') }}
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.advisory-board.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Name Fields -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name_en" class="form-label">{{ __('general.name') }} ({{ __('general.english') }})</label>
                                    <input type="text" 
                                           class="form-control @error('name_en') is-invalid @enderror" 
                                           id="name_en" 
                                           name="name_en" 
                                           value="{{ old('name_en') }}" 
                                           required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name_ar" class="form-label">{{ __('general.name') }} ({{ __('general.arabic') }})</label>
                                    <input type="text" 
                                           class="form-control @error('name_ar') is-invalid @enderror" 
                                           id="name_ar" 
                                           name="name_ar" 
                                           value="{{ old('name_ar') }}" 
                                           required
                                           dir="rtl">
                                    @error('name_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Job Title Fields -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="job_title_en" class="form-label">{{ __('general.job_title') }} ({{ __('general.english') }})</label>
                                    <input type="text" 
                                           class="form-control @error('job_title_en') is-invalid @enderror" 
                                           id="job_title_en" 
                                           name="job_title_en" 
                                           value="{{ old('job_title_en') }}" 
                                           required>
                                    @error('job_title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="job_title_ar" class="form-label">{{ __('general.job_title') }} ({{ __('general.arabic') }})</label>
                                    <input type="text" 
                                           class="form-control @error('job_title_ar') is-invalid @enderror" 
                                           id="job_title_ar" 
                                           name="job_title_ar" 
                                           value="{{ old('job_title_ar') }}" 
                                           required
                                           dir="rtl">
                                    @error('job_title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">{{ __('general.profile_image') }}</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">{{ __('general.image_upload_note') }}</div>
                                </div>
                            </div>

                            <!-- Order -->
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="order" class="form-label">{{ __('general.display_order') }}</label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', 0) }}" 
                                           min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('general.status') }}</label>
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            {{ __('general.active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="row">
                            <div class="col-12">
                                <div id="image-preview" class="mb-3" style="display: none;">
                                    <label class="form-label">{{ __('general.image_preview') }}</label>
                                    <div>
                                        <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('general.save') }}
                        </button>
                        <a href="{{ route('admin.advisory-board.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-times"></i> {{ __('general.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').style.display = 'none';
    }
});
</script>
@endsection
