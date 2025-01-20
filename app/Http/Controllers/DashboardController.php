<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $peminjaman = Peminjaman::all();
        $pengembalian = Pengembalian::all();
        $peminjam = Peminjam::all();
        $totalBarang = Barang::count();
        $totalPinjam = Peminjaman::count();
        $totalKembali = Pengembalian::count();
        $totalAcc = Pengajuan::where('status', 'ACC')->count();
        $totalPr = Pengajuan::where('status', 'Proses')->count();
        $totalPeminjam = Peminjam::count();

        return view('dashboard.index', compact('barang', 'peminjaman', 'pengembalian', 'peminjam', 'totalBarang', 'totalPinjam', 'totalKembali', 'totalAcc', 'totalPr', 'totalPeminjam'));
    }
}
