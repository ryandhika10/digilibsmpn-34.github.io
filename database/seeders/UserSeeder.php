<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin',
            'kode' => '12345',
            'username' => Str::of('Admin')->slug('-'),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'nama' => 'Petugas',
            'kode' => '23456',
            'username' => Str::of('Petugas')->slug('-'),
            'email' => 'petugas@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('petugas');

        User::create([
            'nama' => 'Siswa',
            'kode' => '34567',
            'username' => Str::of('Siswa')->slug('-'),
            'email' => 'siswa@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'siswa_id' => 1,
        ])->assignRole('siswa');

        User::create([
            'nama' => 'Guru',
            'kode' => '123456789101112131',
            'username' => Str::of('Guru')->slug('-'),
            'email' => 'guru@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'guru_id' => 1,
        ])->assignRole('guru');

        User::create([
            'nama' => 'Enang',
            'kode' => '2345678',
            'username' => Str::of('Enang')->slug('-'),
            'email' => 'enang@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'guru_id' => 2,
        ])->assignRole('guru');

        User::create([
            'nama' => 'Ryan Dhika Permana',
            'kode' => '45678',
            'username' => Str::of('Ryan Dhika Permana')->slug('-'),
            'email' => 'ryandhikapermana10@gmail.com',
            // 'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'siswa_id' => 2,
        ])->assignRole('siswa');

        User::create([
            'nama' => 'Enang Dhika',
            'kode' => '56789',
            'username' => Str::of('Enang Dhika')->slug('-'),
            'email' => 'enangdhika@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'siswa_id' => 3,
        ])->assignRole('siswa');
    }
}
