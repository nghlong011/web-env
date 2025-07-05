<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\About;
use App\Livewire\Pages\NewsPage;
use App\Livewire\Pages\NewsDetail;
use App\Livewire\Pages\GalleryPage;
use App\Http\Controllers\LanguageController;

Route::get('/', Home::class)->name('home');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/about', About::class)->name('about');
Route::get('/news', NewsPage::class)->name('news');
Route::get('/news/{slug}', NewsDetail::class)->name('news.detail');
Route::get('/gallery', GalleryPage::class)->name('gallery');
// Language Switcher Route
Route::get('language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index']);
    Route::put('/users/update-password', [\App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('users.update-password');
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
    Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
    Route::get('settings/group/{id}', [\App\Http\Controllers\Admin\SettingController::class, 'showGroup'])->name('settings.group');
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->except(['create', 'store', 'destroy', 'show']);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index']);
    
    // Upload route không cần CSRF
    Route::post('/upload-image', [App\Http\Controllers\Admin\UploadController::class, 'uploadImage'])
        ->name('upload.image')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});