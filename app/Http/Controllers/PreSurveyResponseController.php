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

        // 1. Validasi Dinamis (Server Side)
        $dynamicRules = [];
        $customAttributes = [];

        foreach ($program->formFields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';

            if ($field->field_type == 'text') {
                $rule .= '|string|max:100'; // Mencegah spam text panjang
            } elseif ($field->field_type == 'number') {
                $rule .= '|numeric|digits_between:1,15'; // Mencegah angka tidak wajar
            } elseif ($field->field_type == 'date') {
                $rule .= '|date';
            }

            $dynamicRules['dynamic_data.' . $field->field_label] = $rule;
            $customAttributes['dynamic_data.' . $field->field_label] = $field->field_label;
        }

        $request->validate($dynamicRules, [
            'dynamic_data.*.required' => 'Kolom :attribute wajib diisi.',
            'dynamic_data.*.max' => 'Isian :attribute terlalu panjang (maksimal :max karakter).',
            'dynamic_data.*.numeric' => 'Isian :attribute harus berupa angka.',
            'dynamic_data.*.digits_between' => 'Isian :attribute harus berupa angka valid (maksimal :max digit).',
        ], $customAttributes);

        // 2. Simpan Data
        $inputData = $request->input('dynamic_data', []);
        $detectedName = Auth::user()->username ?? Auth::user()->name;

        foreach ($inputData as $key => $value) {
            if (stripos($key, 'nama') !== false) {
                $detectedName = $value;
                break;
            }
        }

        PreSurveyResponse::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'survey_program_id' => $program->id,
            ],
            [
                'unit_kerja_id' => $unitKerja->id,
                'full_name' => $detectedName,
                'dynamic_data' => $inputData,
                'age' => null,
                'gender' => null,
                'status' => null,
                'unit_kerja_or_fakultas' => null,
            ]
        );

        return redirect()->route('public.survey.fill', [
            'program' => $program->alias,
            'unitKerja' => $unitKerja->alias
        ]);
    }
}
