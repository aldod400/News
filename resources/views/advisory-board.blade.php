@extends('layouts.app')

@section('title', __('general.advisory_board'))

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">
                    {{ __('general.advisory_board') }}
                </h1>
                <div class="border-bottom border-primary mx-auto mb-4" style="width: 100px; height: 3px;"></div>
                <p class="lead text-muted">
                    {{ __('general.advisory_board_description') }}
                </p>
            </div>
        </div>

        <!-- Advisory Board Members -->
        @if($members && $members->count() > 0)
            <div class="row g-4">
                @foreach($members as $member)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100 shadow-sm border-0 advisory-member-card">
                            <div class="card-body text-center p-4">
                                <!-- Member Image -->
                                <div class="mb-4">
                                    @if($member->image)
                                        <img src="{{ asset('storage/uploads/' . $member->image) }}" 
                                             alt="{{ json_decode($member->getRawOriginal('name'), true)[app()->getLocale()] ?? json_decode($member->getRawOriginal('name'), true)['en'] ?? '' }}" 
                                             class="rounded-circle img-fluid advisory-member-img">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center advisory-member-placeholder">
                                            <i class="fas fa-user fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Member Info -->
                                <div class="member-info">
                                    <h4 class="card-title mb-2 fw-bold text-dark">
                                        {{ json_decode($member->getRawOriginal('name'), true)[app()->getLocale()] ?? json_decode($member->getRawOriginal('name'), true)['en'] ?? '' }}
                                    </h4>
                                    <p class="text-primary fw-medium mb-0">
                                        {{ json_decode($member->getRawOriginal('job_title'), true)[app()->getLocale()] ?? json_decode($member->getRawOriginal('job_title'), true)['en'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-users fa-5x text-muted"></i>
                        </div>
                        <h3 class="text-muted mb-3">{{ __('general.no_advisory_board_members') }}</h3>
                        <p class="text-muted">{{ __('general.advisory_board_coming_soon') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.advisory-member-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
}

.advisory-member-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

.advisory-member-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.advisory-member-placeholder {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    border: 4px solid #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.member-info h4 {
    font-size: 1.25rem;
    line-height: 1.4;
}

.member-info p {
    font-size: 1rem;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .advisory-member-img,
    .advisory-member-placeholder {
        width: 120px;
        height: 120px;
    }
    
    .member-info h4 {
        font-size: 1.1rem;
    }
    
    .member-info p {
        font-size: 0.9rem;
    }
}

/* RTL Support */
@if(app()->getLocale() == 'ar')
.card-body {
    text-align: center !important;
}

.member-info h4,
.member-info p {
    direction: rtl;
    text-align: center;
}
@endif
</style>
@endsection
