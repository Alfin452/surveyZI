<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_kerja_id', 
        'title',
        'alias',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'requires_pre_survey',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'requires_pre_survey' => 'boolean',
        'is_featured' => 'boolean',
    ];
    public function getRouteKeyName()
    {
        return 'alias';
    }
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
    public function targetedUnitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'survey_program_unit_kerja');
    }
    public function questionSections()
    {
        return $this->hasMany(QuestionSection::class)->orderBy('order_column', 'asc');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function preSurveyResponses()
    {
        return $this->hasMany(PreSurveyResponse::class);
    }
}
