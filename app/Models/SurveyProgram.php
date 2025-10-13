<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyProgram extends Model
{
    use HasFactory;

    /**
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'alias',
        'description',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     */
    public function getRouteKeyName()
    {
        return 'alias';
    }

    /**
     */
    public function targetedUnitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'survey_program_unit_kerja');
    }

    /**
     */
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
}
