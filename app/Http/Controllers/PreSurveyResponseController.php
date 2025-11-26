<?php

namespace App\Http\Controllers;

use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreSurveyResponseController extends Controller
{
    public function create(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        $program->load(['formFields' => function ($q) {
            $q->orderBy('order');
        }]);

        return view('public.pre-survey-form', compact('program', 'unitKerja'));
    }

    public function store(Request $request, SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        // 1. Validasi Dinamis
        $dynamicRules = [];
        $customAttributes = [];

        foreach ($program->formFields as $field) {
            if ($field->is_required) {
                $rule = 'required';
                if ($field->field_type == 'number') $rule .= '|numeric';
                if ($field->field_type == 'date')   $rule .= '|date';

                $dynamicRules['dynamic_data.' . $field->field_label] = $rule;
                $customAttributes['dynamic_data.' . $field->field_label] = $field->field_label;
            }
        }

        $request->validate($dynamicRules, [], $customAttributes);

        // 2. Ambil Data Input
        $inputData = $request->input('dynamic_data', []);

        // Auto-detect Nama (Prioritas: Input Form -> Auth User)
        $detectedName = Auth::user()->username ?? Auth::user()->name;
        foreach ($inputData as $key => $value) {
            if (stripos($key, 'nama') !== false) {
                $detectedName = $value;
                break;
            }
        }

        // 3. SIMPAN KE DATABASE (SOLUSI ERROR DUPLICATE)
        // Gunakan updateOrCreate agar tidak error jika user resubmit/back
        PreSurveyResponse::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'survey_program_id' => $program->id,
                // Kita kunci berdasarkan User & Program. 
                // Artinya 1 User hanya punya 1 Data Diri per Program.
            ],
            [
                'unit_kerja_id' => $unitKerja->id, // Update unit kerja jika berubah
                'full_name' => $detectedName,
                'dynamic_data' => $inputData,

                // Kolom legacy null
                'age' => null,
                'gender' => null,
                'status' => null,
                'unit_kerja_or_fakultas' => null,
            ]
        );

        // Redirect ke pengisian survei utama
        return redirect()->route('public.survey.fill', [
            'program' => $program->alias,
            'unitKerja' => $unitKerja->alias
        ]);
    }
}
