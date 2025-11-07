<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\Answer; 

class DashboardController extends Controller
{
    /**
     */
    public function index()
    {
        $totalPrograms = SurveyProgram::count();
        $totalUnitKerja = UnitKerja::count();
        $totalUsers = User::count(); // Total semua pengguna (admin, user, dll)

        $totalRespondents = Answer::distinct('user_id')->count();

        return view('superadmin.dashboard', compact(
            'totalPrograms',
            'totalUnitKerja',
            'totalUsers',
            'totalRespondents'
        ));
    }
}
