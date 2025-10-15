<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\Schema; // DITAMBAHKAN

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();

        Schema::enableForeignKeyConstraints();

        Role::create([
            'role_name' => 'Superadmin',
            'code'      => 'SA'
        ]); // Akan mendapatkan ID 1

        Role::create([
            'role_name' => 'Admin',
            'code'      => 'ADM'
        ]);      // Akan mendapatkan ID 2

        Role::create([
            'role_name' => 'User',
            'code'      => 'USR'
        ]);       // Akan mendapatkan ID 3
    }
}
