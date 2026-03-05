<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VideoGalleryController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

// Storage link helper route (run once after deployment)
Route::get('/storage-link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

// Optimize route (run after deployment to cache config/routes/views)
Route::get('/optimize', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize');
    return 'Optimized successfully!';
});

// Root → redirect to default locale
Route::get('/', function () {
    $locale = SiteSetting::instance()->default_locale ?? 'az';
    return redirect('/' . $locale);
});

// Locale-prefixed group
Route::prefix('{locale}')->middleware('setlocale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
    Route::get('/proficiency-tests', [ExperimentController::class, 'show'])->name('experiment.show');
    Route::get('/video-gallery', [VideoGalleryController::class, 'index'])->name('video-gallery');
});
