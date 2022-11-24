<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penerbit = ['none', 'PT.Gramedia Pustaka Utama', 'CV.Empat Pilar Pendidikan', 'Alam Budaya', 'CV.Vania Books', 'Eazy Book'];
        foreach ($penerbit as $value) {
            Penerbit::create([
                'nama' => $value,
                'slug' => Str::slug($value),
            ]);
        }
    }
}
