<?php

namespace Database\Seeders;

use App\Models\Ebook;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ebook = Ebook::create([
            'judul' => 'Buku Bahasa Inggris SMP Kelas 8',
            'slug' => Str::slug('Buku Bahasa Inggris SMP Kelas 8'),
            'sampul' => 'ebook/Buku Bahasa Inggris SMP Kelas 8.jpg',
            'penulis' => 'None',
            'tahun_terbit' => 'None',
            'dilihat' => 0,
            'file' => 'file/Buku Bahasa Inggris SMP Kelas 8.pdf',
            'tempat_terbit_id' => 1,
            'penerbit_id' => 1,
            'kategori_id' => 11,
        ]);
        $ebook->kategori->increment('digunakan');

        $ebook = Ebook::create([
            'judul' => 'Buku IPA SMP Kelas 8 Semester 1',
            'slug' => Str::slug('Buku IPA SMP Kelas 8 Semester 1'),
            'sampul' => 'ebook/Buku IPA SMP Kelas 8 Semester 1.jpg',
            'penulis' => 'None',
            'tahun_terbit' => 'None',
            'dilihat' => 0,
            'file' => 'file/Buku IPA SMP Kelas 8 Semester 1.pdf',
            'tempat_terbit_id' => 1,
            'penerbit_id' => 1,
            'kategori_id' => 11,
        ]);
        $ebook->kategori->increment('digunakan');

        $ebook = Ebook::create([
            'judul' => 'Buku IPA SMP Kelas 9 Semester 2',
            'slug' => Str::slug('Buku IPA SMP Kelas 9 Semester 2'),
            'sampul' => 'ebook/Buku IPA SMP Kelas 9 Semester 2.jpg',
            'penulis' => 'None',
            'tahun_terbit' => 'None',
            'dilihat' => 0,
            'file' => 'file/Buku IPA SMP Kelas 9 Semester 2.pdf',
            'tempat_terbit_id' => 1,
            'penerbit_id' => 1,
            'kategori_id' => 11,
        ]);
        $ebook->kategori->increment('digunakan');

        $ebook = Ebook::create([
            'judul' => 'Buku Matematika SMP Kelas 7 Semester 2',
            'slug' => Str::slug('Buku Matematika SMP Kelas 7 Semester 2'),
            'sampul' => 'ebook/Buku Matematika SMP Kelas 7 Semester 2.jpg',
            'penulis' => 'None',
            'tahun_terbit' => 'None',
            'dilihat' => 0,
            'file' => 'file/Buku Matematika SMP Kelas 7 Semester 2.pdf',
            'tempat_terbit_id' => 1,
            'penerbit_id' => 1,
            'kategori_id' => 11,
        ]);
        $ebook->kategori->increment('digunakan');

        $ebook = Ebook::create([
            'judul' => 'Buku IPS SMP Kelas 8',
            'slug' => Str::slug('Buku IPS SMP Kelas 8'),
            'sampul' => 'ebook/Buku IPS SMP Kelas 8.jpg',
            'penulis' => 'None',
            'tahun_terbit' => 'None',
            'dilihat' => 0,
            'file' => 'file/Buku IPS SMP Kelas 8.pdf',
            'tempat_terbit_id' => 1,
            'penerbit_id' => 1,
            'kategori_id' => 11,
        ]);
        $ebook->kategori->increment('digunakan');
    }
}
