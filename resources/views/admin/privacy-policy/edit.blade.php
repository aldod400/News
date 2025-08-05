@extends('layouts.admin')

@section('title', __('general.edit_privacy_policy'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('general.edit_privacy_policy') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.privacy-policy.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('general.back') }}
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.privacy-policy.update', $policy->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Title Fields -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">{{ __('general.title') }} ({{ __('general.english') }})</label>
                                    <input type="text" 
                                           class="form-control @error('title_en') is-invalid @enderror" 
                                           id="title_en" 
                                           name="title_en" 
                                           value="{{ old('title_en', json_decode($policy->getRawOriginal('title'), true)['en'] ?? '') }}" 
                                           required>
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_ar" class="form-label">{{ __('general.title') }} ({{ __('general.arabic') }})</label>
                                    <input type="text" 
                                           class="form-control @error('title_ar') is-invalid @enderror" 
                                           id="title_ar" 
                                           name="title_ar" 
                                           value="{{ old('title_ar', json_decode($policy->getRawOriginal('title'), true)['ar'] ?? '') }}" 
                                           required
                                           dir="rtl">
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Content Fields -->
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="content_en" class="form-label">{{ __('general.content') }} ({{ __('general.english') }})</label>
                                    <textarea class="form-control ckeditor @error('content_en') is-invalid @enderror" 
                                              id="content_en" 
                                              name="content_en" 
                                              rows="15" 
                                              required>{{ old('content_en', json_decode($policy->getRawOriginal('content'), true)['en'] ?? '') }}</textarea>
                                    @error('content_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="content_ar" class="form-label">{{ __('general.content') }} ({{ __('general.arabic') }})</label>
                                    <textarea class="form-control ckeditor @error('content_ar') is-invalid @enderror" 
                                              id="content_ar" 
                                              name="content_ar" 
                                              rows="15" 
                                              required
                                              dir="rtl">{{ old('content_ar', json_decode($policy->getRawOriginal('content'), true)['ar'] ?? '') }}</textarea>
                                    @error('content_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1" 
                                               {{ old('is_active', $policy->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            {{ __('general.set_as_active_policy') }}
                                        </label>
                                        <div class="form-text">
                                            {{ __('general.active_policy_note') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Policy Info -->
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>{{ __('general.policy_information') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>{{ __('general.created') }}:</strong> {{ $policy->created_at->format('Y-m-d H:i') }}</p>
                                            <p class="mb-0"><strong>{{ __('general.last_updated') }}:</strong> 
                                                @if($policy->last_updated)
                                                    {{ $policy->last_updated->format('Y-m-d H:i') }}
                                                @else
                                                    {{ $policy->updated_at->format('Y-m-d H:i') }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>{{ __('general.current_status') }}:</strong> 
                                                @if($policy->is_active)
                                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('general.update') }}
                        </button>
                        <a href="{{ route('admin.privacy-policy.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-times"></i> {{ __('general.cancel') }}
                        </a>
                        @if(!$policy->is_active)
                            <a href="{{ route('admin.privacy-policy.set-active', $policy->id) }}" 
                               class="btn btn-success ms-2"
                               onclick="return confirm('{{ __('general.confirm_set_active') }}')">
                                <i class="fas fa-check"></i> {{ __('general.set_as_active') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor for English content
    CKEDITOR.replace('content_en', {
        height: 400,
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'Preview' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
        ]
    });

    // Initialize CKEditor for Arabic content
    CKEDITOR.replace('content_ar', {
        height: 400,
        language: 'ar',
        contentsLangDirection: 'rtl',
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'Preview' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
        ]
    });
});
</script>
@endsection
