@extends('layouts.app')

@section('title', __('general.privacy_policy'))

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">
                    {{ __('general.privacy_policy') }}
                </h1>
                <div class="border-bottom border-primary mx-auto mb-4" style="width: 150px; height: 3px;"></div>
                @if($policy)
                    <p class="text-muted">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{ __('general.last_updated') }}: {{ $policy->formatted_last_updated ?? $policy->updated_at->translatedFormat('j F Y') }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Privacy Policy Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                @if($policy)
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5">
                            <!-- Policy Title -->
                            <div class="mb-4">
                                <h2 class="h3 text-dark mb-3 fw-bold">
                                    {{ json_decode($policy->getRawOriginal('title'), true)[app()->getLocale()] ?? json_decode($policy->getRawOriginal('title'), true)['en'] ?? __('general.privacy_policy') }}
                                </h2>
                            </div>

                            <!-- Policy Content -->
                            <div class="privacy-content">
                                {!! json_decode($policy->getRawOriginal('content'), true)[app()->getLocale()] ?? json_decode($policy->getRawOriginal('content'), true)['en'] ?? '' !!}
                            </div>

                            <!-- Last Updated Info -->
                            <div class="mt-5 pt-4 border-top">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-info-circle me-2"></i>
                                            {{ __('general.last_updated') }}
                                        </p>
                                        <p class="fw-medium">
                                            {{ $policy->formatted_last_updated ?? $policy->updated_at->translatedFormat('j F Y') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-envelope me-2"></i>
                                            {{ __('general.contact_us_for_questions') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- No Policy Available -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-shield-alt fa-5x text-muted"></i>
                        </div>
                        <h3 class="text-muted mb-3">{{ __('general.no_privacy_policy') }}</h3>
                        <p class="text-muted mb-4">{{ __('general.privacy_policy_coming_soon') }}</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>
                            {{ __('general.contact_us') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Navigation -->
        @if($policy)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card bg-light border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="mb-2">{{ __('general.have_questions') }}</h5>
                                    <p class="text-muted mb-0">{{ __('general.privacy_policy_questions_text') }}</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <a href="{{ route('contact') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-envelope me-2"></i>{{ __('general.contact_us') }}
                                    </a>
                                    <a href="{{ route('index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-home me-2"></i>{{ __('general.home') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.privacy-content {
    line-height: 1.8;
    font-size: 1.05rem;
}

.privacy-content h1,
.privacy-content h2,
.privacy-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.privacy-content h1 {
    font-size: 1.8rem;
    border-bottom: 2px solid #3498db;
    padding-bottom: 0.5rem;
}

.privacy-content h2 {
    font-size: 1.5rem;
}

.privacy-content h3 {
    font-size: 1.3rem;
}

.privacy-content p {
    margin-bottom: 1.2rem;
    text-align: justify;
}

.privacy-content ul,
.privacy-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.privacy-content li {
    margin-bottom: 0.5rem;
}

.privacy-content strong {
    color: #2c3e50;
}

.privacy-content blockquote {
    border-left: 4px solid #3498db;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.25rem;
}

/* RTL Support */
@if(app()->getLocale() == 'ar')
.privacy-content {
    direction: rtl;
    text-align: right;
}

.privacy-content ul,
.privacy-content ol {
    padding-right: 2rem;
    padding-left: 0;
}

.privacy-content blockquote {
    border-right: 4px solid #3498db;
    border-left: none;
    padding-right: 1rem;
    padding-left: 1rem;
}
@endif
</style>
@endsection
