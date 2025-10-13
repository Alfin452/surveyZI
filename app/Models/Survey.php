<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Survey extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'survey_program_id',
        'unit_kerja_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'requires_pre_survey',
        'is_template', 
        'is_global_template', 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'requires_pre_survey' => 'boolean',
        'is_template' => 'boolean',
        'is_global_template' => 'boolean',
    ];

    /**
     */
    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }

    /**
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_column', 'asc');
    }

    /**
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        return $query;
    }
}
