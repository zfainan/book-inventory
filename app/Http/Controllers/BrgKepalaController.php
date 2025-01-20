<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BrgKepalaController extends Controller
{
    //index
    function index(){
        $data = Barang::latest()->paginate();
        return view('barangkepala.index', compact('data'));
    }
}
