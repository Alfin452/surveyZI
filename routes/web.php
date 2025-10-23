<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SurveyProgramController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\UnitKerjaController as SuperadminUnitKerjaController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use App\Http\Controllers\Superadmin\SurveyController as SuperadminSurveyController;
use App\Http\Controllers\Superadmin\QuestionController as SuperadminQuestionController;
use App\Http\Controllers\Superadmin\SurveyResultController;
use App\Http\Controllers\Superadmin\QuestionOrderController;


use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\UnitKerjaAdmin\DashboardController as UnitKerjaDashboardController;
use App\Http\Controllers\UnitKerjaAdmin\ProgramController as UnitKerjaProgramController;
use App\Http\Controllers\UnitKerjaAdmin\SurveyController as UnitKerjaSurveyController;
use App\Http\Controllers\UnitKerjaAdmin\QuestionController as UnitKerjaQuestionController;



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
        Route::resource('surveys', SuperadminSurveyController::class);
        Route::resource('surveys.questions', SuperadminQuestionController::class)->except(['index']);
        Route::get('/surveys/{survey}/results', [SurveyResultController::class, 'show'])->name('surveys.results');
        Route::post('surveys/{survey}/questions/reorder', [QuestionOrderController::class, '__invoke'])->name('surveys.questions.reorder');
        Route::post('programs/{program}/clone', [SurveyProgramController::class, 'cloneProgram'])->name('programs.clone');
});

//unitkerja
Route::middleware(['auth', 'verified', 'is.unitkerja.admin'])
    ->prefix('unit-kerja-admin')
    ->name('unitkerja.admin.')
    ->group(function () {

        Route::get('/dashboard', [UnitKerjaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/programs', [UnitKerjaProgramController::class, 'index'])->name('programs.index');
        Route::resource('surveys', UnitKerjaSurveyController::class);
        Route::resource('surveys.questions', UnitKerjaQuestionController::class)->except(['index']);
});
