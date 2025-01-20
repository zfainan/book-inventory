<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengajuan;
use Error;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    //tampilan awal 
    public function index(){

        $pengajuan = DB::table('pengajuan')
        ->where('status', 'ACC')
        ->get();

        $pengajuan1 = DB::table('pengajuan')
        ->where('status', 'Tolak')
        ->orWhere('status', 'Proses')
        ->get();


        return view('pengajuan.index',compact('pengajuan', 'pengajuan1'));
    }

    public function create()
    {
        
        return view('pengajuan.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255', // Judul wajib diisi
            'jumlah' => 'required|integer|min:1', // Jumlah harus berupa integer minimal 1
            'jenis' => 'required|string', // Jenis wajib diisi
            'penerbit' => 'required|string|max:255', // Penerbit wajib diisi
            'harga' => 'required|integer|min:0', // Harga harus berupa integer minimal 0
        ], [
            'judul.required' => 'Judul wajib diisi!',
            'jumlah.required' => 'Jumlah wajib diisi!',
            'jenis.required' => 'Jenis wajib diisi!',
            'penerbit.required' => 'Penerbit wajib diisi!',
            'harga.required' => 'Harga wajib diisi!',
        ]);
        

        Pengajuan::create([
            'judul' => $request->judul,
            'jumlah' => $request->jumlah,
            'jenis' => $request->jenis,
            'penerbit' => $request->penerbit,
            'harga' => $request->harga,
            'status' => 'Proses', 
        ]);
        
        
        return redirect('/pengajuan')->with('success','Data Pengajuan berhasil di simpan !');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menghapus data dengan ID
        DB::table('pengajuan')->where('id', $id)->delete();
    
        return response()->json(['status' => 'Data Berhasil di hapus!']);
    }
    
}
