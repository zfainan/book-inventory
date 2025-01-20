<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Level::firstOrCreate([
            'nama_level' => 'Administrator',
        ]);

        Level::firstOrCreate([
            'nama_level' => 'Operator',
        ]);

        Level::firstOrCreate([
            'nama_level' => 'Peminjam',
        ]);
    }
}
