<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'nama' => 'Siswa',
            'kelas' => '8D',
            'nis' => '34567',
        ]);
        Siswa::create([
            'nama' => 'Ryan Dhika Permana',
            'kelas' => '9A',
            'nis' => '45678',
        ]);
        Siswa::create([
            'nama' => 'Enang Dhika',
            'kelas' => '9E',
            'nis' => '56789',
        ]);
        Siswa::create([
            'nama' => 'Dude',
            'kelas' => '7C',
            'nis' => '67891',
        ]);
    }
}
