<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $pengembalian = Pengembalian::all();
        $peminjaman = Peminjaman::all();
        $datap = Pengembalian::latest()->paginate();
        $data = Peminjaman::latest()->paginate();
        return view('peminjaman.index', compact('datap', 'data', 'peminjaman', 'pengembalian', 'barang'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peminjam = Peminjam::all();
        $data = Barang::all();

        return view('peminjaman.create', compact('data', 'peminjam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_peminjam' => 'required|numeric|exists:peminjam,id',
            'id_barang' => 'required|numeric|exists:barang,id',
            'jumlah_pinjam' => 'required|numeric|min:0|max:99999',
            'keperluan' => 'required',
        ], [
            'id_peminjam.required' => 'Field nama peminjam tidak boleh kosong!',
            'id_barang.required' => 'Field nama barang tidak boleh kosong!',
            'jumlah_pinjam.required' => 'Field jumlah pinjam tidak boleh kosong!',
            'jumlah_pinjam.min' => 'Jumlah pinjam minimal 1!',
            'jumlah_pinjam.max' => 'Jumlah pinjam maksimal 99999!',
            'keperluan.required' => 'Field keperluan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->to('/peminjaman/create')->withErrors($validator)->withInput();
        }

        $peminjam = Peminjam::findOrFail($request->id_peminjam);
        $barang = Barang::findOrFail($request->id_barang);
        $pinjam = $request->integer('jumlah_pinjam');

        if ($barang->qty < $pinjam) {
            return redirect()->to('/peminjaman/create')->withErrors(['Error' => 'Jumlah pinjam tidak boleh lebih dari stok yang ada !'])->withInput();
        }

        DB::transaction(function () use ($barang, $pinjam, $peminjam, $request) {
            $barang->update([
                'qty' => $barang->qty - $pinjam,
            ]);

            Peminjaman::create([
                'barang_id' => $barang->id,
                'nama_peminjam' => $peminjam->nama,
                'nama_barang' => $barang->nama_barang,
                'jumlah_pinjam' => $pinjam,
                'keperluan' => $request->get('keperluan'),
            ]);
        });

        return redirect('/peminjaman')->with('success', 'Data berhasil ditambahkan !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findoirfile($id);
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Validasi input
        $request->validate([
            'qty_rusak' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Simpan data pengembalian
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'nama_peminjam' => $peminjaman->nama_peminjam,
                'nama_barang' => $peminjaman->nama_barang,
                'jumlah_pinjam' => $peminjaman->jumlah_pinjam,
                'tgl_pinjam' => $peminjaman->created_at,
                'keperluan' => $peminjaman->keperluan,
            ]);

            if ($request->has('qty_rusak')) {
                $peminjaman->barang->fill([
                    'qty_rusak' => $peminjaman->barang->qty_rusak + $request->qty_rusak,
                ]);
            }

            $peminjaman->barang?->fill([
                'qty' => ($peminjaman->barang->qty + $peminjaman->jumlah_pinjam) - $request->integer('qty_rusak', 0),
            ])->save();

            // Hapus data peminjaman setelah selesai
            Peminjaman::destroy($peminjaman->id);

            DB::commit();

            return redirect('/peminjaman')->with('success', 'Peminjaman berhasil diselesaikan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);

            return redirect('/peminjaman')->with('error', 'Terjadi kesalahan saat mengembalikan barang!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Pengembalian::find($id);
        $barang->delete();

        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }
}
