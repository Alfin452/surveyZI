<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'survey_program_id', 
        'question_body',
        'type',
        'order_column',
    ];

    /**
     */
    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }

    /**
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}

