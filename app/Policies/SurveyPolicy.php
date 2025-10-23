<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SurveyPolicy
{
    /**
     */
    public function before(User $user, string $ability): bool|null
    {
        if (strtolower($user->role?->role_name) === 'superadmin') {
            return true;
        }
        return null; 
    }

    /**
     */
    public function view(User $user, Survey $survey): bool
    {
        return $user->unit_kerja_id === $survey->unit_kerja_id;
    }

    /**
     */
    public function create(User $user): bool
    {
        return strtolower($user->role?->role_name) === 'admin';
    }

    /**
\     */
    public function update(User $user, Survey $survey): bool
    {
        // Aturan sama seperti 'view'
        return $user->unit_kerja_id === $survey->unit_kerja_id;
    }

    /**
     */
    public function delete(User $user, Survey $survey): bool
    {
        // Aturan sama seperti 'view'
        return $user->unit_kerja_id === $survey->unit_kerja_id;
    }
}
