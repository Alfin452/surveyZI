<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreSurveyResponse extends Model
{
    use HasFactory;

    /**
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'survey_program_id', 
        'user_id',
        'full_name',
        'gender',
        'age',
        'status',
        'unit_kerja_or_fakultas',
        'dynamic_data', // <--- WAJIB ADA
    ];

    protected $casts = [
        'dynamic_data' => 'array', // PENTING: Auto convert JSON <-> Array
    ];

    /**
     */
    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }

    /**
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}

