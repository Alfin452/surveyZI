<?php

namespace App\Http\Controllers;

use App\Models\PreSurveyResponse;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreSurveyResponseController extends Controller
{
    /**
     */
    public function create(SurveyProgram $program, $unitKerjaAlias)
    {
        // PERBAIKAN: Mencari UnitKerja secara manual
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        return view('public.pre-survey-form', compact('program', 'unitKerja'));
    }

    /**
     */
    public function store(Request $request, SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        $validated = $request->validate([
            'full_name'                 => 'required|string|max:255',
            'gender'                    => 'required|string|in:Laki-laki,Perempuan',
            'age'                       => 'required|integer|min:15|max:100',
            'status'                    => 'required|string|max:255',
            'unit_kerja_or_fakultas'    => 'required|string|max:255',
        ]);

        $user = Auth::user();

        PreSurveyResponse::updateOrCreate(
            [
                'survey_program_id' => $program->id,
                'user_id'   => $user->id,
            ],
            $validated
        );

        return redirect()->route('public.survey.fill', ['program' => $program, 'unitKerja' => $unitKerja]);
    }
}
