<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = ['none', 'petualangan', 'romantis', 'drama', 'remaja', 'Ilmu Pengetahuan', 'Pengalaman', 'Personal', 'Pelajaran'];
        Kategori::create([
            'nama' => $kategori[0],
            'slug' => Str::slug($kategori[0]),
            'digunakan' => 0,
            'jenis_kategori_id' => 1
        ]);

        Kategori::create([
            'nama' => $kategori[0],
            'slug' => Str::slug($kategori[0]),
            'digunakan' => 0,
            'jenis_kategori_id' => 2
        ]);

        Kategori::create([
            'nama' => $kategori[0],
            'slug' => Str::slug($kategori[0]),
            'digunakan' => 0,
            'jenis_kategori_id' => 3
        ]);

        Kategori::create([
            'nama' => $kategori[1],
            'slug' => Str::slug($kategori[1]),
            'digunakan' => 0,
            'jenis_kategori_id' => 1
        ]);

        Kategori::create([
            'nama' => $kategori[2],
            'slug' => Str::slug($kategori[2]),
            'digunakan' => 0,
            'jenis_kategori_id' => 1
        ]);

        Kategori::create([
            'nama' => $kategori[3],
            'slug' => Str::slug($kategori[3]),
            'digunakan' => 0,
            'jenis_kategori_id' => 1
        ]);

        Kategori::create([
            'nama' => $kategori[4],
            'slug' => Str::slug($kategori[4]),
            'digunakan' => 0,
            'jenis_kategori_id' => 1
        ]);

        Kategori::create([
            'nama' => $kategori[5],
            'slug' => Str::slug($kategori[5]),
            'digunakan' => 0,
            'jenis_kategori_id' => 3
        ]);

        Kategori::create([
            'nama' => $kategori[6],
            'slug' => Str::slug($kategori[6]),
            'digunakan' => 0,
            'jenis_kategori_id' => 3
        ]);

        Kategori::create([
            'nama' => $kategori[7],
            'slug' => Str::slug($kategori[7]),
            'digunakan' => 0,
            'jenis_kategori_id' => 3
        ]);

        Kategori::create([
            'nama' => $kategori[8],
            'slug' => Str::slug($kategori[8]),
            'digunakan' => 0,
            'jenis_kategori_id' => 2
        ]);
    }
}
