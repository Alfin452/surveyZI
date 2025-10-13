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
        // DITAMBAHKAN: Nonaktifkan foreign key check untuk sementara
        Schema::disableForeignKeyConstraints();

        // Mengosongkan tabel sebelum diisi
        DB::table('roles')->truncate();

        // DITAMBAHKAN: Aktifkan kembali foreign key check
        Schema::enableForeignKeyConstraints();

        // Membuat data peran yang dibutuhkan menggunakan Model
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
