<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_program_id',
        'title',
        'description',
        'order_column',
    ];
    public function surveyProgram()
    {
        return $this->belongsTo(SurveyProgram::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_column', 'asc');
    }
}
