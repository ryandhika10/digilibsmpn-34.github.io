<?php

namespace Database\Seeders;

use App\Models\JenisKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisKategori = ['Buku', 'Ebook', 'Blog'];
        foreach ($jenisKategori as $value) {
            JenisKategori::create([
                'kategori' => $value
            ]);
        }
    }
}
