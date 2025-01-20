<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengajuan;

class KepalaController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $peminjaman = Peminjaman::all();
        $pengembalian = Pengembalian::all();
        $peminjam = Peminjam::all();
        $pengajuan = Pengajuan::all();
        $totalBarang = Barang::count();
        $totalAcc = Pengajuan::where('status', 'ACC')->count();
        $totalPr = Pengajuan::where('status', 'Proses')->count();

        return view('dashboardkepala.index', compact(
            'barang',
            'peminjaman',
            'pengembalian',
            'peminjam',
            'pengajuan',
            'totalBarang',
            'totalAcc',
            'totalPr'
        ));
    }
}
