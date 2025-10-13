<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
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
        'jenis_responden',
        'asal_responden',
        'email_verified',
        'is_active',
    ];

    /**
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi ke Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     */
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
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
