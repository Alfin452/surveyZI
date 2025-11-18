<?php

namespace App\Http\Requests\Superadmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyProgramRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     * Kita set true karena ini di-handle oleh route middleware (superadmin).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Siapkan data untuk validasi.
     * Kita pindahkan logika 'merge' Anda ke sini.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'targeted_unit_kerjas' => $this->input('targeted_unit_kerjas', [])
        ]);
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan ini.
     */
    public function rules(): array
    {
        // Pindahkan semua aturan dari SurveyProgramController::store
        return [
            'title' => 'required|string|max:255|unique:survey_programs,title',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array|min:1',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
        ];
    }

    /**
     * Dapatkan pesan kesalahan kustom untuk aturan validasi.
     */
    public function messages(): array
    {
        return [
            'targeted_unit_kerjas.required' => 'Anda harus memilih minimal satu unit kerja.',
            'targeted_unit_kerjas.min' => 'Anda harus memilih minimal satu unit kerja.',
        ];
    }
}
