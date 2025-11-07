<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SurveyProgram;
use App\Models\Answer;

class DashboardController extends Controller
{
    /**
     */
    public function index()
    {
        $user = Auth::user();
        $unitKerja = $user->unitKerja;

        if (!$unitKerja) {
            $totalPrograms = 0;
            $totalResponden = 0;
        } else {
            $totalPrograms = SurveyProgram::where('is_active', true)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->whereHas('targetedUnitKerjas', function ($query) use ($unitKerja) {
                    $query->where('unit_kerja_id', $unitKerja->id);
                })
                ->count();

            $totalResponden = Answer::where('unit_kerja_id', $unitKerja->id)
                ->distinct('user_id')
                ->count('user_id');
        }

        return view('unit_kerja_admin.dashboard', compact(
            'unitKerja',
            'totalPrograms',
            'totalResponden'
        ));
    }
}
