<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\CarouselController as AdminCarouselController;
use App\Http\Controllers\Admin\HomepageHeroController as AdminHomepageHeroController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index'])->name('public.services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('public.services.show');
Route::post('/appointments', [AppointmentController::class, 'store']);
Route::prefix('mens')->group(function () {
    Route::get('/services', function () {
        return redirect('/Mens/services', 301);
    });
    Route::get('/services/{slug}', function ($slug) {
        return redirect('/Mens/services/' . $slug, 301);
    });
    Route::get('/admin/login', function () {
        return redirect('/Mens/admin/login', 301);
    });
    Route::get('/{path?}', function ($path = '') {
        return redirect('/Mens/' . ltrim($path, '/'), 301);
    })->where('path', '.*');
});
Route::get('/explore', function () {
    return redirect(url('/#services'));
});
Route::get('/open', function () {
    return redirect(url('/#services'));
});

Route::get('/our-specialists', function () {
    return redirect('/services');
});
Route::get('/about-us', function () {
    return redirect('/services');
});
Route::get('/contact', function () {
    return redirect(url('/#booking-form'));
});
Route::get('/blogs', function () {
    return redirect('/services');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        Route::resource('/services', AdminServiceController::class)->except(['show']);
        Route::resource('/homepage-heroes', AdminHomepageHeroController::class)->except(['show']);

        Route::get('/appointments', [AdminAppointmentController::class, 'index']);
        Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show']);
        Route::put('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus']);
        Route::delete('/appointments/{appointment}', [AdminAppointmentController::class, 'destroy']);

        Route::resource('/faqs', AdminFaqController::class)->except(['show']);

        Route::get('/settings', [AdminSettingController::class, 'index']);
        Route::put('/settings', [AdminSettingController::class, 'update']);

        Route::get('/carousel', [AdminCarouselController::class, 'index']);
        Route::post('/carousel', [AdminCarouselController::class, 'store']);
        Route::put('/carousel/{id}', [AdminCarouselController::class, 'update']);
        Route::delete('/carousel/{id}', [AdminCarouselController::class, 'destroy']);
    });
});
