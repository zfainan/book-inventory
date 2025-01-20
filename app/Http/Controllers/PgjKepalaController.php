<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;

class PgjKepalaController extends Controller
{
    //index
    function index(){
        

        $pengajuan = DB::table('pengajuan')
        ->where('status', 'ACC')
        ->get();

        $pengajuan1 = DB::table('pengajuan')
        ->where('status', 'Tolak')
        ->orWhere('status', 'Proses')
        ->get();

        return view('pengajuankepala.index',compact('pengajuan', 'pengajuan1'));
    }

    //update status pengajuan
    public function updateStatus(Request $request, $id)
{

    // Validasi input status
    $request->validate([
        'status' => 'required|in:Proses,ACC,TOLAK',
    ]);

    // Update status menggunakan query builder
    DB::table('pengajuan')
        ->where('id', $id)
        ->update(['status' => $request->status]);

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui!');
}

}
