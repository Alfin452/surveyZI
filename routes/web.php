<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//superadmin
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Superadmin\SurveyProgramController as SuperadminSurveyProgramController;
use App\Http\Controllers\Superadmin\UnitKerjaController as SuperadminUnitKerjaController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use App\Http\Controllers\Superadmin\ReportController;
use App\Http\Controllers\Superadmin\QuestionSectionController as SuperadminQuestionSectionController;
use App\Http\Controllers\Superadmin\QuestionController as SuperadminQuestionController;
use App\Http\Controllers\Superadmin\ProgramResultController;


//Admin Unit Kerja
use App\Http\Controllers\UnitKerjaAdmin\DashboardController as UnitKerjaDashboardController;
use App\Http\Controllers\UnitKerjaAdmin\ProgramController as UnitKerjaProgramController;
use App\Http\Controllers\UnitKerjaAdmin\SurveyResultController as UnitKerjaSurveyResultController;
use App\Http\Controllers\UnitKerjaAdmin\SurveyProgramController as UnitKerjaSurveyProgramController;
use App\Http\Controllers\UnitKerjaAdmin\QuestionSectionController as UnitKerjaQuestionSectionController;
use App\Http\Controllers\UnitKerjaAdmin\QuestionController as UnitKerjaQuestionController;
use App\Http\Controllers\UnitKerjaAdmin\ProfileController;


//Publik
use App\Http\Controllers\PublicSurveyController;
use App\Http\Controllers\SurveyResponseController;
use App\Http\Controllers\PreSurveyResponseController;
use App\Http\Controllers\Public\RespondentProfileController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicSurveyController::class, 'showHome'])->name('home');
Route::get('/program-survei', [PublicSurveyController::class, 'showProgramList'])->name('public.programs.list');
Route::get('/tentang', [PublicSurveyController::class, 'showTentangPage'])->name('public.tentang');
Route::get('/dashboard', [LoginController::class, 'dashboardRedirect'])->middleware(['auth', 'verified'])->name('dashboard');

//=======//
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('google.callback');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profil', [RespondentProfileController::class, 'showProfile'])->name('public.profile');
    Route::post('/profil', [RespondentProfileController::class, 'updateProfile'])->name('public.profile.update');
    Route::get('/riwayat-survei', [RespondentProfileController::class, 'showHistory'])->name('public.profile.history');

    Route::prefix('program')->group(function () {
        Route::get('/thank-you', [SurveyResponseController::class, 'thankYou'])->name('public.survey.thankyou');
        Route::get('/{program:alias}', [PublicSurveyController::class, 'showDirectory'])->name('public.survey.directory');
        Route::get('/{program:alias}/{unitKerja:alias}', [PublicSurveyController::class, 'showUnitLanding'])->name('public.unit.landing');
        Route::get('/{program}/{unitKerja:alias}/fill', [SurveyResponseController::class, 'showFillForm'])->name('public.survey.fill');
        Route::post('/{program}/{unitKerja:alias}/fill', [SurveyResponseController::class, 'storeResponse'])->name('public.survey.storeResponse');
        Route::get('/{program}/{unitKerja:alias}/pre-survey', [PreSurveyResponseController::class, 'create'])->name('public.pre-survey.create');
        Route::post('/{program}/{unitKerja:alias}/pre-survey', [PreSurveyResponseController::class, 'store'])->name('public.pre-survey.store');
    });
});


Route::middleware(['auth', 'verified', 'is.superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('unit-kerja', SuperadminUnitKerjaController::class);
        Route::resource('users', SuperadminUserController::class);
        Route::resource('programs', SuperadminSurveyProgramController::class);
        Route::post('programs/{program}/clone', [SuperadminSurveyProgramController::class, 'cloneProgram'])->name('programs.clone');
        Route::get('programs/{program}/questions', [SuperadminSurveyProgramController::class, 'showQuestionsPage'])->name('programs.questions.index');
        Route::get('programs/{program}/questions/create', [SuperadminSurveyProgramController::class, 'createQuestion'])->name('programs.questions.create');
        Route::post('programs/{program}/questions', [SuperadminSurveyProgramController::class, 'storeQuestion'])->name('programs.questions.store');
        Route::get('programs/{program}/questions/{question}/edit', [SuperadminSurveyProgramController::class, 'editQuestion'])->name('programs.questions.edit');
        Route::put('programs/{program}/questions/{question}', [SuperadminSurveyProgramController::class, 'updateQuestion'])->name('programs.questions.update');
        Route::delete('programs/{program}/questions/{question}', [SuperadminSurveyProgramController::class, 'destroyQuestion'])->name('programs.questions.destroy');
        Route::post('programs/{program}/questions/reorder', [SuperadminSurveyProgramController::class, 'reorderQuestions'])->name('programs.questions.reorder');
        Route::get('programs/{program}/results', [ProgramResultController::class, 'showResults'])->name('programs.results');
        Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/{program_id}/{unit_kerja_id}', [ReportController::class, 'showUnitDetail'])->name('reports.showUnit');
        Route::get('/laporan/export', [ReportController::class, 'export'])->name('reports.export');

    Route::prefix('programs/{program}/sections')->name('programs.sections.')->group(function () {
        Route::post('/', [SuperadminQuestionSectionController::class, 'store'])->name('store');
        Route::post('/reorder', [SuperadminQuestionSectionController::class, 'reorder'])->name('reorder');
    });
    Route::prefix('sections/{section}')->name('sections.')->group(function () {
        Route::put('/', [SuperadminQuestionSectionController::class, 'update'])->name('update');
        Route::delete('/', [SuperadminQuestionSectionController::class, 'destroy'])->name('destroy');
        Route::resource('questions', SuperadminQuestionController::class)->except(['index', 'show']);
        Route::post('/questions/reorder', [SuperadminQuestionController::class, 'reorder'])->name('questions.reorder');
    });
});



//ADMIN UNIT KERJA ---
Route::middleware(['auth', 'verified', 'is.unitkerja.admin'])
    ->prefix('unit-kerja-admin')
    ->name('unitkerja.admin.')
    ->group(function () {

        Route::get('/dashboard', [UnitKerjaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profil-unit-kerja', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil-unit-kerja', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/programs', [UnitKerjaProgramController::class, 'index'])->name('programs.index');
        Route::get('/programs/{program}/results', [UnitKerjaSurveyResultController::class, 'show'])->name('programs.results');
        Route::resource('my-programs', UnitKerjaSurveyProgramController::class)->parameters(['my-programs' => 'program']);
        Route::post('my-programs/{program}/clone', [UnitKerjaSurveyProgramController::class, 'cloneProgram'])->name('my-programs.clone');Route::get('my-programs/{program}/questions', [UnitKerjaSurveyProgramController::class, 'showQuestionsPage'])->name('programs.questions.index');
    
    Route::prefix('my-programs/{program}/sections')->name('programs.sections.')->group(function () {
        Route::post('/', [UnitKerjaQuestionSectionController::class, 'store'])->name('store');
        Route::post('/reorder', [UnitKerjaQuestionSectionController::class, 'reorder'])->name('reorder');
    });
    Route::prefix('my-sections/{section}')->name('sections.')->group(function () {
        Route::put('/', [UnitKerjaQuestionSectionController::class, 'update'])->name('update');
        Route::delete('/', [UnitKerjaQuestionSectionController::class, 'destroy'])->name('destroy');
        Route::resource('questions', UnitKerjaQuestionController::class)->except(['index', 'show']);
        Route::post('/questions/reorder', [UnitKerjaQuestionController::class, 'reorder'])->name('questions.reorder');
    });
});
