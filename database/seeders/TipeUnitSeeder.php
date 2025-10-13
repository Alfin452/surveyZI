<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // DITAMBAHKAN

class TipeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('tipe_units')->truncate();

        Schema::enableForeignKeyConstraints();

        DB::table('tipe_units')->insert([
            ['nama_tipe_unit' => 'Rektorat', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Universitas', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Fakultas Ekonomi dan Bisnis Islam', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Fakultas Dakwah dan Ilmu Komunikasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Fakultas Syariah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Fakultas Tarbiyah dan Keguruan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Fakultas Ushuluddin dan Humaniora', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Pascasarjana', 'created_at' => now(), 'updated_at' => now()],
            ['nama_tipe_unit' => 'Umum', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
