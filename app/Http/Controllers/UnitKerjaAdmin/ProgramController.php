<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $user = Auth::user();
        $unitKerjaId = $user->unit_kerja_id;

        $programsQuery = SurveyProgram::where('is_active', true)
            ->whereHas('targetedUnitKerjas', function ($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            });

        $programsQuery->with(['surveys' => function ($query) use ($unitKerjaId) {
            $query->where('unit_kerja_id', $unitKerjaId);
        }]);

        $programsQuery->withCount(['surveys' => function ($query) use ($unitKerjaId) {
            $query->where('unit_kerja_id', $unitKerjaId);
        }]);

        $programs = $programsQuery->latest()->paginate(10);

        return view('unit_kerja_admin.programs.index', compact('programs'));
    }
}

