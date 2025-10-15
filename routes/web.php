<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SurveyProgramController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\UnitKerjaController as SuperadminUnitKerjaController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// PERBAIKAN: Rute /dashboard sekarang menjadi "penyalur" cerdas yang akan mengarahkan pengguna
Route::get('/dashboard', [LoginController::class, 'dashboardRedirect'])->middleware(['auth', 'verified'])->name('dashboard');

//login
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('google.callback');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


//superadmin
Route::middleware(['auth', 'verified', 'is.superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('programs', SurveyProgramController::class);
        Route::resource('unit-kerja', SuperadminUnitKerjaController::class);
        Route::resource('users', SuperadminUserController::class);
    });

//unitkerja
Route::middleware(['auth', 'verified', 'is.unitkerja.admin'])
    ->prefix('unit-kerja-admin')
    ->name('unitkerja.admin.')
    ->group(function () {});
