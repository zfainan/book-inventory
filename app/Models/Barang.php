<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'pengarang',
        'penerbit',
        'qty_rusak',
        'qty',
        'asal',
        'jenis_buku'
    ];

    public function peminjaman(){
        return $this->hasOne(Peminjaman::class);
    }
    public function pengembalian(){
        return $this->hasOne(pengembalian::class);
    }
}
