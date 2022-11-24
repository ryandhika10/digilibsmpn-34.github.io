<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'petugas']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'siswa']);
        Role::create(['name' => 'alumni']);
    }
}
