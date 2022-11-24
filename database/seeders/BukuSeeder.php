<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buku = Buku::create([
            'judul' => 'Misteri Chip Fin Stabilizers',
            'slug' => Str::slug('Misteri Chip Fin Stabilizers'),
            'sampul' => 'buku/Misteri Chip Fin Stabilizers.jpg',
            'penulis' => 'Rina Dyah Rahmawati',
            'tahun_terbit' => '2006',
            'dilihat' => 0,
            'tempat_terbit_id' => 3,
            'penerbit_id' => 3,
            'kategori_id' => 4,
            'rak_id' => 2,
            'stok' => 3
        ]);
        $buku->kategori->increment('digunakan');

        $buku = Buku::create([
            'judul' => 'Hatiku Masih Perawan',
            'slug' => Str::slug('Hatiku Masih Perawan'),
            'sampul' => 'buku/Hatiku Masih Perawan.jpg',
            'penulis' => 'Maria A. Sardjono',
            'tahun_terbit' => '2006',
            'dilihat' => 0,
            'tempat_terbit_id' => 2,
            'penerbit_id' => 4,
            'kategori_id' => 5,
            'rak_id' => 5,
            'stok' => 1
        ]);
        $buku->kategori->increment('digunakan');

        $buku = Buku::create([
            'judul' => 'Masih Ada Kereta Yang akan Lewat',
            'slug' => Str::slug('Masih Ada Kereta Yang akan Lewat'),
            'sampul' => 'buku/Masih Ada Kereta Yang akan Lewat.jpg',
            'penulis' => 'Mira .W',
            'tahun_terbit' => '2009',
            'dilihat' => 0,
            'tempat_terbit_id' => 2,
            'penerbit_id' => 2,
            'kategori_id' => 5,
            'rak_id' => 5,
            'stok' => 1
        ]);
        $buku->kategori->increment('digunakan');

        $buku = Buku::create([
            'judul' => 'Melati',
            'slug' => Str::slug('Melati'),
            'sampul' => 'buku/Melati.jpg',
            'penulis' => 'Dea Marta',
            'tahun_terbit' => '2008',
            'dilihat' => 0,
            'tempat_terbit_id' => 2,
            'penerbit_id' => 5,
            'kategori_id' => 6,
            'rak_id' => 8,
            'stok' => 1
        ]);
        $buku->kategori->increment('digunakan');

        $buku = Buku::create([
            'judul' => 'Finding Perfect Lover',
            'slug' => Str::slug('Finding Perfect Lover'),
            'sampul' => 'buku/Finding Perfect Lover.jpg',
            'penulis' => 'Dita Safitri',
            'tahun_terbit' => '2013',
            'dilihat' => 0,
            'tempat_terbit_id' => 3,
            'penerbit_id' => 6,
            'kategori_id' => 7,
            'rak_id' => 11,
            'stok' => 1
        ]);
        $buku->kategori->increment('digunakan');
    }
}
