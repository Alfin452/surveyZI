<?php

namespace App\Providers;

// DITAMBAHKAN: Import model dan policy yang akan kita daftarkan
use App\Models\SurveyProgram;
use App\Policies\SurveyPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // PERBAIKAN: Mendaftarkan policy baru kita di sini
        SurveyProgram::class => SurveyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
