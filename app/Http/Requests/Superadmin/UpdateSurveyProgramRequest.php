<?php

namespace App\Http\Requests\Superadmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- PENTING: Tambahkan ini

class UpdateSurveyProgramRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Siapkan data untuk validasi.
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
        // Pindahkan aturan dari SurveyProgramController::update
        // Kita butuh ID program untuk aturan 'unique'
        $programId = $this->route('program')->id;

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('survey_programs')->ignore($programId)
            ],
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
