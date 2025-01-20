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
        'qty',
        'pengarang',
        'penerbit',
        'asal',
        'jenis_buku',
        'qty_rusak',
        'type',
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
