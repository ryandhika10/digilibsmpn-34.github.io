<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guru::create([
            'nama' => 'Guru',
            'nip' => '123456789101112131',
        ]);
        Guru::create([
            'nama' => 'Enang',
            'nip' => '2345678',
        ]);
        Guru::create([
            'nama' => 'Bu Guru',
            'nip' => '3456789',
        ]);
        Guru::create([
            'nama' => 'Pak Guru',
            'nip' => '4567891',
        ]);
    }
}
