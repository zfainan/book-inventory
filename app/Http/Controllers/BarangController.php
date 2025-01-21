<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::groupBy('kode_barang', 'nama_barang', 'pengarang', 'penerbit', 'asal', 'jenis_buku', 'type')
            ->select(
                'kode_barang',
                'nama_barang',
                'pengarang',
                'penerbit',
                'asal',
                'jenis_buku',
                'type',
                DB::raw('COUNT(*) as qty')
            )
            ->orderBy('kode_barang')
            ->get();

        return view('barang.index', compact('data'));
    }


    public function code(string $code)
    {
        $data = Barang::with('peminjaman')
            ->where('kode_barang', $code)
            ->get();
        $buku = $data->first();
        $stock = $data->count();
        $damaged = $data->where('rusak', true)->count();

        return view('barang.code', compact('data', 'buku', 'stock', 'damaged'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'kode_barang' => 'required|string|max:255|unique:barang',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'pengarang' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'jenis_buku' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'asal' => 'nullable|string|in:Hadiah,Beli,Lain-lain',
        ]);

        // Simpan data ke tabel barang
        for ($i = 1; $i <= $request->integer('qty'); $i++) {
            $barang = new Barang();
            $barang->fill([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'asal' => $request->asal,
                'qty' => 0,
                'serial_number' => $request->integer('qty') > 1 ? $i : null,
            ]);

            // Simpan data yang spesifik untuk jenis barang Buku
            if ($request->jenis_barang == 'Buku') {
                $barang->fill([
                    'pengarang' => $request->pengarang,
                    'penerbit' => $request->penerbit,
                    'jenis_buku' => $request->jenis_buku,
                ]);
            }

            // Simpan data yang spesifik untuk jenis barang Elektronik
            if ($request->jenis_barang == 'Elektronik') {
                $barang->fill([
                    'type' => $request->type,
                ]);
            }

            // Simpan data ke dalam database
            $barang->save();
        }

        // Setelah data berhasil disimpan, tampilkan pesan sukses
        return redirect('/barang')->with('status', 'Data barang berhasil disimpan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'rusak' => 'required|boolean',
        ], [
            'rusak.boolean' => 'Kolom Kondisi harus berupa Baik atau Rusak',
        ]);

        $barang->update([
            'rusak' => $request->rusak,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect(route('barang.index'))->with('success', 'Data Berhasil di hapus!');
    }

    public function bulkEdit(string $code)
    {
        return view('barang.edit', [
            'barang' => Barang::where('kode_barang', $code)->first(),
        ]);
    }

    public function bulkUpdate(Request $request, string $code)
    {
        $request->validate([
            'kode_barang' => ['required', 'string', 'max:255', Rule::unique('barang', 'kode_barang')->ignore($code, 'kode_barang')],
            'nama_barang' => 'required|string|max:255',
            'pengarang' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'jenis_buku' => 'nullable|string|max:255',
            'asal' => 'nullable|string|max:255',
        ]);

        Barang::where('kode_barang', $code)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'jenis_buku' => $request->jenis_buku,
            'asal' => $request->asal,
        ]);

        return redirect(route('barang.code', ['code' => $request->kode_barang]))->with('success', 'Data berhasil diupdate!');
    }
}
