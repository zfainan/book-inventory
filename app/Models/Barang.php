<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function peminjaman(): HasOne
    {
        return $this->hasOne(Peminjaman::class);
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(pengembalian::class);
    }
}
