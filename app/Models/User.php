<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

// DITAMBAHKAN: Import model yang akan kita relasikan
use App\Models\Role;
use App\Models\UnitKerja;
use App\Models\Answer;
use App\Models\PreSurveyResponse;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'google_id',
        'role_id',
        'unit_kerja_id',
        'jenis_responden', // Kolom untuk profil
        'asal_responden',  // Kolom untuk profil
        'gender',          // Kolom untuk profil
        'age',             // Kolom untuk profil
        'is_active',
        'email_verified', // Ditambahkan dari kode Anda
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime', // Dihapus dari kode Anda, diganti di bawah
            'password' => 'hashed',
            'email_verified' => 'boolean', // Diambil dari kode Anda
            'is_active' => 'boolean', // Diambil dari kode Anda
        ];
    }

    /**
     * Relasi: Pengguna ini memiliki satu Peran (Role).
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi: Pengguna ini (jika Admin) terikat pada satu Unit Kerja.
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * DITAMBAHKAN: Relasi: Pengguna ini memiliki banyak Jawaban.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * DITAMBAHKAN: Relasi: Pengguna ini memiliki banyak data respons pra-survei.
     * Ini akan memperbaiki error "garis merah" Anda.
     */
    public function preSurveyResponses()
    {
        return $this->hasMany(PreSurveyResponse::class);
    }

    /**
     * Scope filter untuk pencarian di panel admin.
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['role'] ?? false, function ($query, $role) {
            $query->where('role_id', $role);
        });
    }
}
