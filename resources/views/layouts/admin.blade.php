<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('components.admin-header')
    
    {{-- RTL Support --}}
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('admin/img/kaiadmin/logo_light.jpg') }}" alt="navbar brand"
                            class="navbar-brand" height="60" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li
                            class="nav-item {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#news">
                                <i class="fas fa-newspaper"></i>
                                <p>News</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'show' : '' }}"
                                id="news">
                                <ul class="nav nav-collapse">
                                    @if (auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('admin.news.manage') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Editor') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('news.status') }}">
                                                <span class="sub-item">Status</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('news.create') }}">
                                                <span class="sub-item">Create</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @if (auth()->user()->hasRole('Super Admin'))
                            <li class="nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#category">
                                    <i class="fas fa-list"></i>
                                    <p>Category</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.category.*') ? 'show' : '' }}" id="category">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('admin.category.manage') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item {{ Route::is('admin.robots-txt.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.robots-txt.index') }}">
                                    <i class="fas fa-robot"></i>
                                    <p>Robots.txt</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.site-settings.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.site-settings.index') }}">
                                    <i class="fas fa-cogs"></i>
                                    <p>إعدادات الموقع والشركة</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.about-us.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.about-us.index') }}">
                                    <i class="fas fa-info-circle"></i>
                                    <p>About Us</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.advisory-board.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.advisory-board.index') }}">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Advisory Board</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.privacy-policy.index') }}">
                                    <i class="fas fa-shield-alt"></i>
                                    <p>Privacy Policy</p>
                                </a>
                            </li>
                        @endif

                        <!-- Contact Messages -->
                        @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                            <li class="nav-item {{ Route::is('admin.contact-messages.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.contact-messages.index') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>رسائل الاتصال</p>
                                    <span class="badge badge-danger" id="unread-messages-count" style="display: none;"></span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                            <li
                                class="nav-item {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#users">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Users</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'show' : '' }}"
                                    id="users">
                                    <ul class="nav nav-collapse">
                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <li>
                                                <a href="{{ route('admin.users.manage') }}">
                                                    <span class="sub-item">Manage</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('news.draft') }}">
                                                <span class="sub-item">Draft</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ asset('admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            {{-- Language Switcher --}}
                            <li class="nav-item topbar-icon me-3">
                                <x-language-switcher />
                            </li>
                            
                            <li class="nav-item topbar-icon dropdown hidden-caret me-4">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" id="unread-notification-count"></span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            @if (auth()->user()->notifications->count() > 0)
                                                You have notifications
                                            @else
                                                Nothing notifications
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center" id="notifications-container">
                                                {{-- JS --}}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/default.jpeg') }}"
                                            alt="Profile Picture" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/default.jpeg') }}"
                                                        alt="Profile Picture" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider bg-light"></div>
                                            <a class="dropdown-item"
                                                href="{{ route('profile.edit', auth()->user()->id) }}">My
                                                Profile</a>
                                            <div class="dropdown-divider bg-light"></div>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Logout</button>
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        {{-- <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul> --}}
                    </nav>
                    <div class="copyright">
                        2025, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="https://marketopiasystems.com/">MarketopiaTeam</a>
                    </div>
                    {{-- <div>
                        Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>

    @include('components.admin-footer')
    
    <!-- Contact Messages Notification -->
    <script>
    // Load unread messages count
    function loadUnreadCount() {
        @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
        fetch('{{ route("admin.contact-messages.unread-count") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('unread-messages-count');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => console.error('Error loading unread count:', error));
        @endif
    }
    
    // Load count on page load
    document.addEventListener('DOMContentLoaded', loadUnreadCount);
    
    // Refresh count every 30 seconds
    setInterval(loadUnreadCount, 30000);
    </script>
</body>

</html>
