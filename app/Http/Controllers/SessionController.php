<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index(){
        return view("login/index");
    }

    function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);
    
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($infologin)) {
            // Ambil data user yang sedang login
            $user = Auth::user();
    
            // Periksa id_role
            if ($user->id_role == 1) {
                return redirect('dashboard')->with('success', 'SELAMAT DATANG ADMIN :)');
            } elseif ($user->id_role == 2) {
                return redirect('dashboardkepala')->with('success', 'SELAMAT DATANG KEPALA SEKOLAH :)');
            } elseif ($user->id_role == 3) {
                return redirect('dashboardkepala')->with('success', 'SELAMAT PETUGAS PERPUS :)');
            } else {
                // Jika ada role lain
                return redirect('sesi')->withErrors(['Error' => 'Role tidak dikenali'])->withInput();
            }
        } else {
            return redirect('sesi')->withErrors(['Error' => 'Username atau password salah, tolong cek kembali !'])->withInput();
        }
    }
    

    function logout(){
        Auth::logout();
        return redirect('/sesi')->with('success','Telah berhasil log out !');
    }

}
