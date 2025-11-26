<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyProgramFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_program_id',
        'field_label',
        'field_type',     // text, number, select, radio, date
        'field_options',  // JSON (array opsi untuk select/radio)
        'is_required',
        'order',
    ];

    // Casting otomatis agar field_options langsung jadi Array saat diakses
    protected $casts = [
        'field_options' => 'array',
        'is_required' => 'boolean',
    ];

    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }
}
