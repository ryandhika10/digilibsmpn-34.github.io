<?php

namespace Database\Seeders;

use App\Models\Rak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rak::create([
            'rak' => 0,
            'baris' => 0,
            'kategori_id' => 1,
            'slug' => 0,
        ]);

        for ($i = 1; $i <= 3; $i++) {
            Rak::create([
                'rak' => 1,
                'baris' => $i,
                'kategori_id' => 4,
                'slug' => 1 . '-' . $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            Rak::create([
                'rak' => 2,
                'baris' => $i,
                'kategori_id' => 5,
                'slug' => 2 . '-' . $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            Rak::create([
                'rak' => 3,
                'baris' => $i,
                'kategori_id' => 6,
                'slug' => 3 . '-' . $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            Rak::create([
                'rak' => 4,
                'baris' => $i,
                'kategori_id' => 7,
                'slug' => 4 . '-' . $i,
            ]);
        }
    }
}
