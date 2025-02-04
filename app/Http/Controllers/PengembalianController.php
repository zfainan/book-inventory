<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Hapus data dari tabel pengembalian
            $deleted = DB::table('pengembalian')->where('id', $id)->delete();
    
            // Jika penghapusan berhasil
            if ($deleted) {
                return response()->json([
                    'status' => 'Data Berhasil di hapus!'
                ]);
            } else {
                // Jika data tidak ditemukan atau gagal dihapus
                return response()->json([
                    'status' => 'Data Gagal Dihapus!'
                ], 500); // Status 500 untuk error server
            }
    
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => 'Data Gagal Dihapus!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
