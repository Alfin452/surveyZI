<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'requires_pre_survey',
        'is_featured', // DITAMBAHKAN
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'requires_pre_survey' => 'boolean',
        'is_featured' => 'boolean', // DITAMBAHKAN
    ];

    /**
     * Memberitahu Laravel untuk menggunakan 'alias' saat mencari model dari URL.
     */
    public function getRouteKeyName()
    {
        return 'alias';
    }

    /**
     * Relasi: Program ini ditargetkan ke banyak Unit Kerja.
     */
    public function targetedUnitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'survey_program_unit_kerja');
    }

    /**
     * PERUBAHAN: Program ini sekarang langsung memiliki banyak Pertanyaan.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_column', 'asc');
    }

    /**
     * PERUBAHAN: Program ini sekarang langsung memiliki banyak Jawaban.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * PERUBAHAN: Program ini sekarang langsung memiliki banyak data Pra-Survei.
     */
    public function preSurveyResponses()
    {
        return $this->hasMany(PreSurveyResponse::class);
    }
}
