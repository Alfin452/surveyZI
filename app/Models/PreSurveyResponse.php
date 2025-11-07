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
}
