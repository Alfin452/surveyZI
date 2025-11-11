<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_section_id', 
        'question_body',
        'type',
        'order_column',
    ];
    public function questionSection()
    {
        return $this->belongsTo(QuestionSection::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
