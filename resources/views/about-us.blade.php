@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="container py-3">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="display-4 text-center mb-3">{{ __('general.about_us') }}</h1>
                    <hr class="w-25 mx-auto">
                </div>
            </div>

            <!-- Description Section -->
            @if($aboutUs && $aboutUs->description)
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-light p-4 rounded">
                        <h2 class="h3 mb-3 text-primary">{{ __('general.our_story') }}</h2>
                        <div class="lead">
                            {!! $aboutUs->description !!}
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-light p-4 rounded text-center">
                        <h2 class="h3 mb-3 text-primary">{{ __('general.our_story') }}</h2>
                        <p class="text-muted">{{ app()->getLocale() == 'ar' ? 'لم يتم إضافة وصف عن الشركة بعد. يرجى زيارة لوحة التحكم لإضافة المحتوى.' : 'No company description has been added yet. Please visit the admin panel to add content.' }}</p>
                        @if(auth()->check() && auth()->user()->hasRole('Super Admin'))
                        <a href="{{ route('admin.about-us.index') }}" class="btn btn-primary">
                            {{ app()->getLocale() == 'ar' ? 'إدارة المحتوى' : 'Manage Content' }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Editorial Board Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="h3 mb-4 text-center">{{ __('general.editorial_board') }}</h2>
                    @if($editorialBoard->count() > 0)
                    <div class="row g-4">
                        @foreach($editorialBoard as $member)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm">
                                @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $member->name }}"
                                     style="height: 250px; object-fit: cover;">
                                @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 250px;">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                </div>
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $member->name }}</h5>
                                    <p class="card-text text-muted">{{ $member->position }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center bg-light p-4 rounded">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ app()->getLocale() == 'ar' ? 'لم يتم إضافة أعضاء هيئة التحرير بعد.' : 'No editorial board members have been added yet.' }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Offices Section -->
            <div class="row">
                <div class="col-12">
                    <h2 class="h3 mb-4 text-center">{{ __('general.our_offices') }}</h2>
                    @if($offices->count() > 0)
                    <div class="row g-4">
                        @foreach($offices as $office)
                        <div class="col-lg-6 col-md-6">
                            <div class="card h-100 shadow-sm">
                                @if($office->image)
                                <img src="{{ asset('storage/' . $office->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $office->name }}"
                                     style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $office->name }}</h5>
                                    <p class="card-text">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ $office->address }}
                                    </p>
                                    @if($office->phone)
                                    <p class="card-text">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <a href="tel:{{ $office->phone }}" class="text-decoration-none">{{ $office->phone }}</a>
                                    </p>
                                    @endif
                                    @if($office->email)
                                    <p class="card-text">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <a href="mailto:{{ $office->email }}" class="text-decoration-none">{{ $office->email }}</a>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center bg-light p-4 rounded">
                        <i class="fas fa-building fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ app()->getLocale() == 'ar' ? 'لم يتم إضافة مكاتب بعد.' : 'No offices have been added yet.' }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
