<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder-seeder yang telah kita buat.
        // Urutan ini penting: TipeUnit dan Role harus ada sebelum User.
        $this->call([
            TipeUnitSeeder::class,
            RoleSeeder::class,
            // UserSeeder::class, // Kita beri komentar untuk saat ini sesuai permintaan Anda.
        ]);
    }
}
