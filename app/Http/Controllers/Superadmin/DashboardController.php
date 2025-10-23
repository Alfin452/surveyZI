<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// DITAMBAHKAN: Import model yang kita butuhkan untuk statistik
use App\Models\SurveyProgram;
use App\Models\Survey;
use App\Models\UnitKerja;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Super Admin.
     */
    public function index()
    {
        // DITAMBAHKAN: Logika untuk mengambil data statistik
        $totalPrograms = SurveyProgram::count();
        $totalPelaksanaan = Survey::count(); // Ini adalah total survei turunan
        $totalUnitKerja = UnitKerja::count();
        $totalUsers = User::count(); // Total semua pengguna (admin, user, dll)

        return view('superadmin.dashboard', compact(
            'totalPrograms',
            'totalPelaksanaan',
            'totalUnitKerja',
            'totalUsers'
        ));
    }
}
