<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'survey_id',
        'question_body',
        'type',
        'order_column',
    ];

    /**
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
