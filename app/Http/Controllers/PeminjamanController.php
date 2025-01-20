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
        $peminjaman = Peminjaman::with('barang')->latest()->get();
        $pengembalian = Pengembalian::with('barang')->latest()->get();

        return view('peminjaman.index', compact('peminjaman', 'pengembalian'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peminjam = Peminjam::all();
        $data = Barang::where('rusak', false)->whereDoesntHave('peminjaman')->get();

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
            'id_barang' => 'required|array',
            'id_barang.*' => 'required|numeric|exists:barang,id',
            'keperluan' => 'required',
        ], [
            'id_peminjam.required' => 'Field nama peminjam tidak boleh kosong!',
            'id_barang.required' => 'Field nama barang tidak boleh kosong!',
            'keperluan.required' => 'Field keperluan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return redirect()->to('/peminjaman/create')->withErrors($validator)->withInput();
        }

        $peminjam = Peminjam::findOrFail($request->id_peminjam);
        $items = Barang::with('peminjaman')->whereIn('id', $request->get('id_barang'))->get();

        DB::transaction(function () use ($items, $peminjam, $request) {
            foreach ($items as $barang) {
                if ($barang->rusak) {
                    return;
                }

                if ($barang->peminjaman?->id) {
                    return;
                }

                (new Peminjaman())->fill([
                    'nama_peminjam' => $peminjam->nama,
                    'nama_barang' => $barang->nama_barang,
                    'keperluan' => $request->get('keperluan'),
                    'jumlah_pinjam' => 1,
                ])->barang()->associate($barang)->save();
            }
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
            'rusak' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            // Simpan data pengembalian
            (new Pengembalian())->fill([
                'nama_peminjam' => $peminjaman->nama_peminjam,
                'nama_barang' => $peminjaman->nama_barang,
                'jumlah_pinjam' => $peminjaman->jumlah_pinjam,
                'tgl_pinjam' => $peminjaman->created_at,
                'keperluan' => $peminjaman->keperluan,
            ])->barang()->associate($peminjaman->barang)->save();

            if ($request->boolean('rusak')) {
                $peminjaman->barang->update([
                    'rusak' => true,
                ]);
            }

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
