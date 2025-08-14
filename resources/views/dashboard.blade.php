@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Welcome, <span class="fw-bold">{{ auth()->user()->name }}</span></h6>
                </div>
            </div>
            @if (auth()->user()->hasRole('Super Admin'))
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Users</p>
                                            <h4 class="card-title">{{ $totalUsers }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                                            <i class="far fa-newspaper"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total News</p>
                                            <h4 class="card-title">{{ $totalNews }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Publish News</p>
                                            <h4 class="card-title">{{ $totalNewsAccepted }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                                            <i class="fas fa-spinner"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pending News</p>
                                            <h4 class="card-title">{{ $totalNewsNotAccepted }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Multiple Bar Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="multipleBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pie Chart</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Robots.txt Status Card for Super Admin -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title mb-0">
                                    <i class="fas fa-robot me-2"></i>
                                    حالة Robots.txt
                                </div>
                                <a href="{{ route('admin.robots-txt.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-cog"></i> إدارة
                                </a>
                            </div>
                            <div class="card-body">
                                @php
                                    $activeRobotsTxt = \App\Models\RobotsTxt::where('is_active', true)->first();
                                @endphp
                                
                                @if($activeRobotsTxt)
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="text-success">
                                                <i class="fas fa-check-circle"></i>
                                                Robots.txt نشط ويعمل
                                            </h6>
                                            <div class="bg-light p-3 rounded">
                                                <pre style="font-size: 12px; max-height: 150px; overflow-y: auto; margin: 0;">{{ format_robots_txt_preview($activeRobotsTxt->content, 300) }}</pre>
                                            </div>
                                            <small class="text-muted">
                                                آخر تحديث: {{ $activeRobotsTxt->updated_at->format('Y-m-d H:i') }}
                                            </small>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <a href="{{ url('/robots.txt') }}" target="_blank" class="btn btn-outline-primary">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    {{ __('admin.view_robots_txt') }}
                                                </a>
                                                <div class="mt-3">
                                                    <span class="badge bg-success">{{ __('admin.robots_status_active') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ __('admin.no_active_robots') }}
                                        <a href="{{ route('admin.robots-txt.index') }}" class="alert-link">{{ __('admin.create_now') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->hasRole('Writer'))
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-stats card-success card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="far fa-check-circle fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Publish News</p>
                                            <h4 class="card-title">
                                                {{ auth()->user()->news()->where('status', 'Accept')->count() }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats card-warning card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-spinner fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending News</p>
                                            <h4 class="card-title">
                                                {{ auth()->user()->news()->where('status', 'Pending')->count() }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats card-danger card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-times-circle fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Reject News</p>
                                            <h4 class="card-title">
                                                {{ auth()->user()->news()->where('status', 'Reject')->count() }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (auth()->user()->hasRole('Editor'))
                <div class="row">
                    <div class="col-6">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="far fa-newspaper fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total News</p>
                                            <h4 class="card-title">
                                                {{ $totalNews }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-stats card-warning card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="fas fa-spinner fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending News</p>
                                            <h4 class="card-title">
                                                {{ $totalNewsNotAccepted }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-footer')
    <script>
        var usersPerMonth = @json($usersPerMonth);
        var newsPerMonth = @json($newsPerMonth);
        var totalUsersCurrentMonth = @json($totalUsersCurrentMonth);
        var totalNewsCurrentMonth = @json($totalNewsCurrentMonth);
        var currentMonth = @json($currentMonth);
    </script>
    <script src="{{ asset('js/charts.js') }}"></script>
@endsection
