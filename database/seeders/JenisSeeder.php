<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'id_role' => 1,
            'role' => 'Admin',
        ]);

        Role::firstOrCreate([
            'id_role' => 2,
            'role' => 'Kepala',
        ]);

        Role::firstOrCreate([
            'id_role' => 3,
            'role' => 'Peminjam',
        ]);
    }
}
