<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::latest()->paginate();
        return view('barang.index', compact('data'));
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
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255|unique:barang',
            'nama_barang' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'pengarang' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'jenis_buku' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);
    
        // Simpan data ke tabel barang
        $barang = new Barang();
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->qty = $request->qty;
    
        // Simpan data yang spesifik untuk jenis barang Buku
        if ($request->jenis_barang == 'Buku') {
            $barang->pengarang = $request->pengarang;
            $barang->penerbit = $request->penerbit;
            $barang->jenis_buku = $request->jenis_buku;
        }
    
        // Simpan data yang spesifik untuk jenis barang Elektronik
        if ($request->jenis_barang == 'Elektronik') {
            $barang->type = $request->type;
        }
    
        // Simpan data ke dalam database
        $barang->save();
    
        // Setelah data berhasil disimpan, tampilkan pesan sukses
        return redirect('/barang')->with('status', 'Data barang berhasil disimpan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
    return view('barang.edit',[
        'barang' => $barang
    ]);
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
       
        $this->validate($request,[
            'nama_barang' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'qty' => 'required|numeric',
            'asal' => 'required',
            'jenis_buku' => 'required',
        ],[
            'kode_barang.unique' => 'Kode barang sudah ada tolong cek kembali',
            'nama_barang.required' => 'Nama Barang wajib di isi',
            'pengarang.required' => 'Nama Pengarang wajib di isi',
            'penerbit.required' => 'Nama Penerbit wajib di isi',
            'qty.required' => 'qty wajib di isi',
            'asal.required' => 'Asal wajib di isi',
            'jenis_buku.required' => 'Jenis Buku wajib di isi',
        ]);
       
        $rules=[
            'nama_barang' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'qty' => 'required|numeric',
            'asal' => 'required',
            'jenis_buku' => 'required',
        ];

        if($request->kode_barang != $barang->kode_barang){
            $rules['kode_barang'] = 'required|unique:barang|max:50';    
        }

        $validateData = $request->validate($rules);

        Barang::where('id', $barang->id)
        ->update($validateData);

        return Redirect('/barang')->with('success', 'Data berhasil diupdate !');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/barang')->with('succes','Data Berhasil di hapus!');
    }

}
