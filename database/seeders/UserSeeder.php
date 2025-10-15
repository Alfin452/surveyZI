<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminRole = Role::where('role_name', 'Superadmin')->first();

        User::firstOrCreate(
            [
                'email' => 'superadmin@app.com',
            ],
            [
                'username' => 'Super Admin',
                'password' => Hash::make('password'), 
                'role_id' => $superadminRole->id,
                'is_active' => true,
                'email_verified' => true, 
            ]
        );
    }
}
