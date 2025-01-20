<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void 
    {
        // Cek jika 'admin' sudah ada, jika tidak maka insert
        if (!DB::table('users')->where('username', 'admin')->exists()) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
            ]);
        }

        // Cek jika 'operator' sudah ada, jika tidak maka insert
        if (!DB::table('users')->where('username', 'operator')->exists()) {
            DB::table('users')->insert([
                'name' => 'Operator',
                'username' => 'operator',
                'password' => Hash::make('operator123'),
            ]);
        }

        // Cek jika 'peminjam' sudah ada, jika tidak maka insert
        if (!DB::table('users')->where('username', 'peminjam')->exists()) {
            DB::table('users')->insert([
                'name' => 'Peminjam',
                'username' => 'peminjam',
                'password' => Hash::make('peminjam123'),
            ]);
        }
    }
}

