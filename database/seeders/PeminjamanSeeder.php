<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;
use App\Models\DetailPeminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            $faker = Factory::create('id_ID');
            $tanggal_pinjam = $faker->dateTimeBetween('-6 months', '-2 week');
            $tanggal_kembali = Carbon::parse($tanggal_pinjam)->addDays(10);
            $tanggal_pengembalian = Carbon::parse($tanggal_pinjam)->addDays(9);

            $user = User::create([
                'nama' => $faker->name(),
                'username' => $faker->userName(),
                'kode' => $faker->randomNumber(5, true),
                'email' => $faker->email(),
                'password' => bcrypt('password')
            ])->assignRole('peminjam');

            $peminjaman = Peminjaman::create([
                'kode_pinjam' => random_int(10000, 99999),
                'peminjam_id' => $user->id,
                'petugas_pinjam' => random_int(1, 2),
                'petugas_kembali' => random_int(1, 2),
                'denda' => 0,
                'status' => 3,
                'tanggal_pinjam' => $tanggal_pinjam,
                'tanggal_kembali' => $tanggal_kembali,
                'tanggal_pengembalian' => $tanggal_pengembalian,
            ]);

            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'buku_id' => random_int(1, 5)
            ]);
        }
    }
}
