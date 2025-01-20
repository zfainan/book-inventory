<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'judul',
        'jumlah',
        'jenis',
        'penerbit',
        'harga',
        'status'
    ];

    public $timestamps = false; // Karena tabel tidak memiliki kolom timestamps
}
