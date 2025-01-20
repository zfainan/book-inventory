<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'Admin',
                'id_role' => 1,
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'operator',
            ],
            [
                'name' => 'Operator',
                'id_role' => 2,
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'peminjam',
            ],
            [
                'name' => 'Peminjam',
                'id_role' => 3,
                'password' => Hash::make('password'),
            ]
        );
    }
}
