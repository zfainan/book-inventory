<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'asal',
        'jenis_buku',
        'rusak',
        'type',
        'serial_number',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['inventory_code'];

    public function peminjaman(): HasOne
    {
        return $this->hasOne(Peminjaman::class);
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(pengembalian::class);
    }

    public function serialNumber(): Attribute
    {
        return Attribute::make(
            get: fn($val) => $val ? str_pad($val, 4, '0', STR_PAD_LEFT) : null
        );
    }

    public function inventoryCode(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->serial_number
                ? sprintf('%s-%s', $this->kode_barang, $this->serial_number)
                : $this->kode_barang
        );
    }
}
