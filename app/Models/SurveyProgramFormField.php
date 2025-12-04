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
        'field_key',      // <--- Pastikan ini ada
        'field_type',     // <--- Pastikan ini ada (PENTING)
        'max_length',     // <--- Pastikan ini ada
        'field_options',
        'is_required',
        'order',
    ];

    protected $casts = [
        'field_options' => 'array',
        'is_required' => 'boolean',
        // max_length tidak perlu cast khusus, integer otomatis
    ];

    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }
}
