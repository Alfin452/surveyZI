<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'survey_id',
        'unit_kerja_id',
        'question_id',
        'option_id',
        'answer_skor',
    ];

    /**
     *
     * @var array<string, string>
     */
    protected $casts = [
        'answer_skor' => 'integer',
    ];

    /**
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
