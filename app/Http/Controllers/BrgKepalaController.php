<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class BrgKepalaController extends Controller
{
    public function index()
    {
        $data = Barang::latest()->paginate();
        return view('barangkepala.index', compact('data'));
    }
}
