<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Barang;
use App\Models\Pengajuan;
use App\Models\Pengembalian;
use App\Http\Controllers\Controller;

class CetakController extends Controller
{
    function cetakBarang(){
        $barang = Barang::all();
    	$pdf = PDF::loadview('barang.print',['barang'=>$barang]);
    	return $pdf->Stream('laporan-barang-pdf');
    }

   function cetakPeminjaman(){
    
      $pengembalian = Pengembalian::all();
      $datas = Pengembalian::latest()->paginate();
      $pdf = PDF::loadview('peminjaman.cetak',['pengembalian'=>$pengembalian, 'datas' => $datas]);
      return $pdf->Stream('laporan-peminjaman-pdf');
   }

   function cetakPengajuan(){
    $pengajuan = Pengajuan::where('status', 'ACC')->get();

    // Generate PDF dari view
    $pdf = PDF::loadView('pengajuankepala.cetak', ['pengajuan' => $pengajuan]);

    // Unduh file PDF atau tampilkan di browser
    return $pdf->stream('pengajuan_acc.pdf');
}
}



