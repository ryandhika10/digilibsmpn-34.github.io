<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SiswaSeeder::class,
            JenisKategoriSeeder::class,
            KategoriSeeder::class,
            RakSeeder::class,
            PenerbitSeeder::class,
            TempatTerbitSeeder::class,
            BukuSeeder::class,
            TransaksiSeeder::class,
            // PeminjamanSeeder::class,
            EbookSeeder::class,
            GuruSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
        ]);
    }
}
