<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Pengajuan;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Peminjam::create([
            'nama' => 'ADMIN PERPUS',
            'email' => 'adminperpus@gmail.com',
            'alamat' => fake()->address(),
            'no_wa' => fake()->phoneNumber(),
        ]);

        Barang::insert([
            [
                'kode_barang' => 'IU7',
                'nama_barang' => 'SARAF',
                'qty' => 12,
                'pengarang' => null,
                'penerbit' => null,
                'asal' => null,
                'jenis_buku' => null,
                'qty_rusak' => 0,
                'type' => null,
            ],
            [
                'kode_barang' => 'E-001',
                'nama_barang' => 'PRINTER',
                'qty' => 1,
                'pengarang' => null,
                'penerbit' => null,
                'asal' => null,
                'jenis_buku' => null,
                'qty_rusak' => 0,
                'type' => 'EPSON',
            ]
        ]);

        Pengajuan::insert([
            [
                'id' => 15,
                'judul' => 'BUAYA',
                'jumlah' => 20,
                'jenis' => 'Bacaan',
                'penerbit' => 'GRAMEDIA',
                'harga' => 30000,
                'status' => 'ACC',
            ],
            [
                'id' => 17,
                'judul' => 'BUKU REKAYA PERANGKAT LUNAK',
                'jumlah' => 100,
                'jenis' => 'RPL',
                'penerbit' => 'ERLANGGA',
                'harga' => 5000,
                'status' => 'ACC',
            ]
        ]);
    }
}
