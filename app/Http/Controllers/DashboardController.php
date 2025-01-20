<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index(){
        $barang = Barang::all();
        $peminjaman = Peminjaman::all();
        $pengembalian = Pengembalian::all();
        $peminjam = Peminjam::all();
        $totalBarang = DB::table('barang')->count();
        $totalPinjam = DB::table('peminjaman')->count();
        $totalKembali = DB::table('pengembalian')->count();
        $totalAcc = DB::table('pengajuan')->where('status', 'ACC')->count();
        $totalPr = DB::table('pengajuan')->where('status', 'Proses')->count();
        $totalPeminjam = DB::table('peminjam')->count();
        return view('dashboard.index', compact('barang','peminjaman','pengembalian','peminjam','totalBarang', 'totalPinjam', 'totalKembali', 'totalAcc', 'totalPr', 'totalPeminjam'));
    }
}
