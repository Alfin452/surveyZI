<?php

namespace App\Http\Controllers;

use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Tambahkan ini

class PreSurveyResponseController extends Controller
{
    public function create(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        $program->load(['formFields' => function ($q) {
            $q->orderBy('order');
        }]);

        // [TAMBAHAN] Cek apakah user sudah pernah isi data sebelumnya
        $existingResponse = PreSurveyResponse::where('survey_program_id', $program->id)
            ->where('user_id', Auth::id())
            ->first();

        // Pass variabel $existingResponse ke view
        return view('public.pre-survey-form', compact('program', 'unitKerja', 'existingResponse'));
    }
    public function store(Request $request, SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        // 1. Validasi Dinamis (Server Side)
        $dynamicRules = [];
        $customAttributes = [];

        foreach ($program->formFields as $field) {
            // [PERBAIKAN 1] Gunakan field_key (slug) agar cocok dengan name di HTML
            $key = $field->field_key ?? Str::slug($field->field_label, '_');

            // [PERBAIKAN 2] Ambil Max Length dari Database
            $maxLength = $field->max_length ?? 255;

            $rule = $field->is_required ? 'required' : 'nullable';

            if ($field->field_type == 'text') {
                // Gunakan Max Length Dinamis
                $rule .= '|string|max:' . $maxLength;
            } elseif ($field->field_type == 'number') {
                // Gunakan Max Digits Dinamis (Default 15 jika null)
                $maxDigits = $field->max_length ?? 15;
                $rule .= '|numeric|digits_between:1,' . $maxDigits;
            } elseif ($field->field_type == 'date') {
                $rule .= '|date';
            }

            // Set rules berdasarkan KEY (slug)
            $dynamicRules['dynamic_data.' . $key] = $rule;

            // Atribut untuk pesan error tetap menggunakan LABEL agar mudah dibaca user
            $customAttributes['dynamic_data.' . $key] = $field->field_label;
        }

        $request->validate($dynamicRules, [
            'dynamic_data.*.required' => 'Kolom :attribute wajib diisi.',
            'dynamic_data.*.max' => 'Isian :attribute terlalu panjang (maksimal :max karakter).',
            'dynamic_data.*.numeric' => 'Isian :attribute harus berupa angka.',
            'dynamic_data.*.digits_between' => 'Isian :attribute panjangnya harus antara 1 sampai :max digit.',
            'dynamic_data.*.date' => 'Isian :attribute harus berupa tanggal valid.',
        ], $customAttributes);

        // 2. Simpan Data
        $inputData = $request->input('dynamic_data', []);

        // Deteksi Nama Otomatis (Fallback ke User Login)
        $detectedName = Auth::user()->username ?? Auth::user()->name;

        foreach ($inputData as $key => $value) {
            // Cari key yang mengandung kata 'nama' (misal: nama_lengkap, nama_panggilan)
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
                'dynamic_data' => $inputData, // Ini otomatis dicast ke JSON oleh Model
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
