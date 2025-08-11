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
use App\Http\Controllers\ContactController;

// Test route for contact messages controller
Route::get('/test-contact-controller', function() {
    $controller = new App\Http\Controllers\Admin\ContactMessageController();
    return 'Controller exists and can be instantiated!';
});

// All
Route::get('/', [NewsController::class, 'index'])->name('index');
Route::get('/language/{language}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Privacy Policy Page
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy');

// About Us Page  
Route::get('/about-us', [AboutUsController::class, 'show'])->name('about-us');

// Advisory Board Page
Route::get('/advisory-board', [AdvisoryBoardController::class, 'show'])->name('advisory-board');

// Guests and Login/Register
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'registerSubmit'])->name('register.submit');
});

// Authenticated Users
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Like
    Route::post('/like/{id}', [LikeController::class, 'like'])->name('like');

    // News
    Route::get('/view/{id}', [NewsController::class, 'view'])->name('view');

    // Notification
    Route::get('/notifications/{notificationId}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Super Admin only routes
    Route::middleware(['role:Super Admin'])->group(function () {
        // User Management
        Route::post('/admin/users/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assignRole');
        Route::get('/admin/users/manage', [UserController::class, 'manage'])->name('admin.users.manage');
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Category
        Route::resource('/admin/category', CategoryController::class)->names([
            'index' => 'admin.category.index',
            'create' => 'admin.category.create',
            'store' => 'admin.category.store',
            'show' => 'admin.category.show',
            'edit' => 'admin.category.edit',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy'
        ]);

        // Admin News Management
        Route::prefix('admin/news')->name('admin.news.')->group(function () {
            Route::get('/', [NewsController::class, 'manage'])->name('manage');
            Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [NewsController::class, 'update'])->name('update');
            Route::delete('/{id}', [NewsController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/status', [NewsController::class, 'status'])->name('status');
            Route::post('/{id}/status', [NewsController::class, 'statusUpdate'])->name('statusUpdate');
        });

        // Sitemaps (Super Admin only)
        Route::prefix('admin/sitemaps')->name('admin.sitemaps.')->group(function () {
            Route::get('/', [SitemapController::class, 'index'])->name('index');
            Route::post('/generate', [SitemapController::class, 'generate'])->name('generate');
            Route::get('/download/{type}', [SitemapController::class, 'download'])->name('download');
            Route::delete('/delete/{type}', [SitemapController::class, 'delete'])->name('delete');
        });

        // Robots.txt Management (Super Admin only)
        Route::prefix('admin/robots-txt')->name('admin.robots-txt.')->group(function () {
            Route::get('/', [RobotsTxtController::class, 'index'])->name('index');
            Route::post('/', [RobotsTxtController::class, 'store'])->name('store');
            Route::get('/{robotsTxt}/edit', [RobotsTxtController::class, 'edit'])->name('edit');
            Route::put('/{robotsTxt}', [RobotsTxtController::class, 'update'])->name('update');
            Route::delete('/{robotsTxt}', [RobotsTxtController::class, 'destroy'])->name('destroy');
            Route::get('/{robotsTxt}/set-active', [RobotsTxtController::class, 'setActive'])->name('set-active');
        });

        // Site Settings Management (Super Admin only)
        Route::prefix('admin/site-settings')->name('admin.site-settings.')->group(function () {
            Route::get('/', [SiteSettingsController::class, 'index'])->name('index');
            Route::post('/', [SiteSettingsController::class, 'update'])->name('update');
            Route::get('/export-json', [SiteSettingsController::class, 'exportJson'])->name('export-json');
        });

        // About Us Management (Super Admin only)
        Route::prefix('admin/about-us')->name('admin.about-us.')->group(function () {
            Route::get('/', [AboutUsController::class, 'admin'])->name('index');
            Route::post('/description', [AboutUsController::class, 'updateDescription'])->name('update-description');
            Route::post('/editorial', [AboutUsController::class, 'storeEditorial'])->name('store-editorial');
            Route::put('/editorial/{id}', [AboutUsController::class, 'updateEditorial'])->name('update-editorial');
            Route::delete('/editorial/{id}', [AboutUsController::class, 'destroyEditorial'])->name('delete-editorial');
            Route::post('/offices', [AboutUsController::class, 'storeOffice'])->name('store-office');
            Route::put('/offices/{id}', [AboutUsController::class, 'updateOffice'])->name('update-office');
            Route::delete('/offices/{id}', [AboutUsController::class, 'destroyOffice'])->name('delete-office');
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

        // Contact Messages Management (Super Admin only)
        Route::get('admin/contact-messages', 'App\Http\Controllers\Admin\ContactMessageController@index')->name('admin.contact-messages.index');
        Route::get('admin/contact-messages/{id}', 'App\Http\Controllers\Admin\ContactMessageController@show')->name('admin.contact-messages.show');
        Route::put('admin/contact-messages/{id}', 'App\Http\Controllers\Admin\ContactMessageController@update')->name('admin.contact-messages.update');
        Route::delete('admin/contact-messages/{id}', 'App\Http\Controllers\Admin\ContactMessageController@destroy')->name('admin.contact-messages.destroy');
        Route::post('admin/contact-messages/{id}/mark-read', 'App\Http\Controllers\Admin\ContactMessageController@markAsRead')->name('admin.contact-messages.mark-read');
        Route::post('admin/contact-messages/{id}/mark-replied', 'App\Http\Controllers\Admin\ContactMessageController@markAsReplied')->name('admin.contact-messages.mark-replied');
        Route::get('admin/contact-messages/api/unread-count', 'App\Http\Controllers\Admin\ContactMessageController@getUnreadCount')->name('admin.contact-messages.unread-count');
    });
});

// Contact Page (must be before news resource routes)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Writer
Route::group(['middleware' => ['permission:Create News|Store News|Edit News|Update News|Draft']], function () {
    Route::resource('news', NewsController::class)->names('news')->only([
        'create',
        'store',
        'edit',
        'update'
    ]);
    Route::get('/draft', [NewsController::class, 'draft'])->name('news.draft');
});

// Other routes...
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
