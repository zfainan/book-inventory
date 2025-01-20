<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;

class KepalaController extends Controller
{
    //index
    function index(){
        $barang = Barang::all();
        $peminjaman = Peminjaman::all();
        $pengembalian = Pengembalian::all();
        $peminjam = Peminjam::all();
        $pengajuan = Pengajuan::all();
        $totalBarang = DB::table('barang')->count();
        $totalAcc = DB::table('pengajuan')->where('status', 'ACC')->count();
        $totalPr = DB::table('pengajuan')->where('status', 'Proses')->count();
        return view('dashboardkepala.index', compact('barang','peminjaman','pengembalian','peminjam','pengajuan','totalBarang', 'totalAcc', 'totalPr'));
    }
}
