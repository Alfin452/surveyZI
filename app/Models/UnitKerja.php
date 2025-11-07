<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UnitKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_kerja_name',
        'alias',
        'uk_short_name',
        'tipe_unit_id',
        'parent_id',
        'contact',
        'address',
        'start_time',
        'end_time',
    ];

    /**
     * Memberitahu Laravel untuk menggunakan 'alias' saat mencari model dari URL.
     */
    public function getRouteKeyName()
    {
        return 'alias';
    }

    /**
     * Relasi ke Program Survei.
     * Sebuah Unit Kerja bisa ditargetkan oleh banyak Program Survei.
     */
    public function surveyPrograms()
    {
        return $this->belongsToMany(SurveyProgram::class, 'survey_program_unit_kerja');
    }

    /**
     * PERUBAHAN: Relasi 'surveys()' dihapus karena model Survey sudah tidak ada.
     */
    // public function surveys()
    // {
    //     return $this->hasMany(Survey::class);
    // }

    /**
     * Relasi ke Pengguna (User).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relasi ke Tipe Unit.
     */
    public function tipeUnit()
    {
        return $this->belongsTo(TipeUnit::class);
    }

    /**
     * Relasi ke induk (parent).
     */
    public function parent()
    {
        return $this->belongsTo(UnitKerja::class, 'parent_id');
    }

    /**
     * Relasi ke anak (children).
     */
    public function children()
    {
        return $this->hasMany(UnitKerja::class, 'parent_id');
    }

    /**
     * Scope untuk filter.
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('unit_kerja_name', 'like', "%{$search}%")
                    ->orWhere('uk_short_name', 'like', "%{$search}%");
            });
        });

        $query->when($filters['type'] ?? false, fn($query, $type) => $query->where('tipe_unit_id', $type));

        $query->when($filters['parent'] ?? false, fn($query, $parent) => $query->where('parent_id', $parent));
    }
}
