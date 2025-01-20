<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class BrgKepalaController extends Controller
{
    public function index()
    {
        $data = Barang::groupBy('kode_barang', 'nama_barang', 'pengarang', 'penerbit', 'asal', 'jenis_buku', 'type')
            ->select(
                'kode_barang',
                'nama_barang',
                'pengarang',
                'penerbit',
                'asal',
                'jenis_buku',
                'type',
                DB::raw('COUNT(*) as qty')
            )
            ->get();

        return view('barangkepala.index', compact('data'));
    }

    public function code(string $code)
    {
        $data = Barang::with('peminjaman')
            ->where('kode_barang', $code)
            ->get();
        $buku = $data->first();
        $stock = $data->count();
        $damaged = $data->where('rusak', true)->count();

        return view('barangkepala.code', compact('data', 'buku', 'stock', 'damaged'));
    }
}
