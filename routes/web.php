<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RobotsTxtController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdvisoryBoardController;
use App\Http\Controllers\PrivacyPolicyController;

// All
Route::get('/', [NewsController::class, 'index'])->name('index');
Route::get('/news/{news}/show', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{news}/like', [LikeController::class, 'likeNews'])->name('news.like');
Route::get('/news/{categories}/category', [NewsController::class, 'viewCategory'])->name('news.viewCategory');

// Robots.txt & Sitemap
Route::get('/robots.txt', [RobotsTxtController::class, 'serve']);
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Language switching
Route::post('/language/switch', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// About Us Page
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

// Advisory Board Page
Route::get('/advisory-board', [AdvisoryBoardController::class, 'index'])->name('advisory-board');

// Privacy Policy Page
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');

// Guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register/submit', [LoginController::class, 'registerSubmit'])->name('register.submit');
});

// Auth
Route::middleware(['auth', 'online.status'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // News
    Route::get('/news/{news}/view', [NewsController::class, 'view'])->name('news.view');
    // Profile
    Route::resource('profile', UserController::class)->parameters([
        'profile' => 'user'
    ])->only([
        'edit',
        'update'
    ]);
    // Notification
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/count', [NotificationController::class, 'unreadNotificationsCount'])->name('count');
        Route::get('/fetch', [NotificationController::class, 'fetchNotifications'])->name('fetch');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('markAsRead');
    });
});

// Super Admin
Route::middleware(['role:Super Admin'])->group(function () {
    // News
    Route::resource('admin/news', NewsController::class)->names('admin.news')->only([
        'edit',
        'update',
        'destroy'
    ]);
    Route::get('/admin/news/manage', [NewsController::class, 'manage'])->name('admin.news.manage');
    // Category
    Route::resource('admin/category', CategoryController::class)->names('admin.category')->only([
        'store',
        'update',
        'destroy'
    ]);
    Route::get('/admin/category/manage', [CategoryController::class, 'manage'])->name('admin.category.manage');
    // Users
    Route::resource('admin/users', UserController::class)->only(['index', 'destroy'])
        ->names([
            'index' => 'admin.users.manage',
            'destroy' => 'admin.users.destroy'
        ]);

    Route::patch('/admin/users/{user}/assignRole', [UserController::class, 'assignRole'])->name('admin.users.assignRole');
    
    // Robots.txt Management (Super Admin only)
    Route::prefix('admin/robots-txt')->name('admin.robots-txt.')->group(function () {
        Route::get('/', [RobotsTxtController::class, 'index'])->name('index');
        Route::post('/', [RobotsTxtController::class, 'store'])->name('store');
        Route::put('/{robotsTxt}', [RobotsTxtController::class, 'update'])->name('update');
        Route::patch('/{robotsTxt}/set-active', [RobotsTxtController::class, 'setActive'])->name('set-active');
        Route::delete('/{robotsTxt}', [RobotsTxtController::class, 'destroy'])->name('destroy');
    });
    
    // Site Settings Management (Super Admin only)
    Route::prefix('admin/site-settings')->name('admin.site-settings.')->group(function () {
        Route::get('/', [SiteSettingsController::class, 'index'])->name('index');
        Route::put('/', [SiteSettingsController::class, 'update'])->name('update');
        Route::get('/api', [SiteSettingsController::class, 'getCompanyInfo'])->name('api');
    });
    
    // About Us Management (Super Admin only)
    Route::prefix('admin/about-us')->name('admin.about-us.')->group(function () {
        Route::get('/', [AboutUsController::class, 'admin'])->name('index');
        Route::put('/description', [AboutUsController::class, 'updateDescription'])->name('update-description');
        Route::post('/editorial-board', [AboutUsController::class, 'storeEditorialMember'])->name('store-editorial');
        Route::put('/editorial-board/{member}', [AboutUsController::class, 'updateEditorialMember'])->name('update-editorial');
        Route::delete('/editorial-board/{member}', [AboutUsController::class, 'deleteEditorialMember'])->name('delete-editorial');
        Route::post('/offices', [AboutUsController::class, 'storeOffice'])->name('store-office');
        Route::put('/offices/{office}', [AboutUsController::class, 'updateOffice'])->name('update-office');
        Route::delete('/offices/{office}', [AboutUsController::class, 'deleteOffice'])->name('delete-office');
    });
    
    // Advisory Board Management (Super Admin only)
    Route::prefix('admin/advisory-board')->name('admin.advisory-board.')->group(function () {
        Route::get('/', [AdvisoryBoardController::class, 'admin'])->name('index');
        Route::get('/create', [AdvisoryBoardController::class, 'create'])->name('create');
        Route::post('/', [AdvisoryBoardController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdvisoryBoardController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdvisoryBoardController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdvisoryBoardController::class, 'destroy'])->name('destroy');
    });
    
    // Privacy Policy Management (Super Admin only)
    Route::prefix('admin/privacy-policy')->name('admin.privacy-policy.')->group(function () {
        Route::get('/', [PrivacyPolicyController::class, 'admin'])->name('index');
        Route::get('/create', [PrivacyPolicyController::class, 'create'])->name('create');
        Route::post('/', [PrivacyPolicyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PrivacyPolicyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PrivacyPolicyController::class, 'update'])->name('update');
        Route::delete('/{id}', [PrivacyPolicyController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/set-active', [PrivacyPolicyController::class, 'setActive'])->name('set-active');
    });
    
    // Test Map Route (for debugging)
    Route::get('/admin/test-map', function () {
        return view('admin.test-map');
    })->name('admin.test-map');
    
    // Clean Site Settings Test (without dynamic data)
    Route::get('/admin/site-settings-clean', function () {
        return view('admin.site-settings-clean');
    })->name('admin.site-settings-clean');
});

// Editor
Route::group(['middleware' => ['permission:Status News|Update Status News']], function () {
    Route::get('/news/status', [NewsController::class, 'status'])->name('news.status');
    Route::patch('/news/{news}/updatestatus', [NewsController::class, 'updateStatus'])->name('news.updateStatus');
});

// Contact Page (must be before news resource routes)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Writer
Route::group(['middleware' => ['permission:Create News|Store News|Edit News|Update News|Draft']], function () {
    Route::resource('news', NewsController::class)->names('news')->only([
        'create',
        'store',
        'edit',
        'update'
    ]);
    Route::get('/news/draft', [NewsController::class, 'draft'])->name('news.draft');
});
