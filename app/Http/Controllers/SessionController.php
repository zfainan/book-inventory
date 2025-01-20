<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        return view("login.index");
    }

    public function login(Request $request)
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
            return match ($user->role->role) {
                'Admin' => redirect('dashboard')->with('success', 'SELAMAT DATANG ADMIN :)'),
                'Kepala' => redirect('dashboardkepala')->with('success', 'SELAMAT DATANG KEPALA SEKOLAH :)'),
                'Peminjam' => redirect('dashboardkepala')->with('success', 'SELAMAT PETUGAS PERPUS :)'),
                default => redirect('sesi')->withErrors(['Error' => 'Role tidak dikenali'])->withInput(),
            };
        } else {
            return redirect('sesi')->withErrors(['Error' => 'Username atau password salah, tolong cek kembali !'])->withInput();
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/sesi')->with('success', 'Telah berhasil log out !');
    }
}
