<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\TempatTerbit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TempatTerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tempat_terbit = ['none', 'Jakarta', 'Yogyakarta'];
        foreach ($tempat_terbit as $value) {
            TempatTerbit::create([
                'nama' => $value,
                'slug' => Str::slug($value),
            ]);
        }
    }
}
