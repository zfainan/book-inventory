<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\BrgKepalaController;
use App\Http\Controllers\PgjKepalaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [SessionController::class, 'index']);
    Route::get('/sesi', [SessionController::class, 'index'])->name('login');
    Route::post('/sesi/login', [SessionController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/sesi/logout', [SessionController::class, 'logout']);

    Route::redirect('/home', '/dashboard');
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/dashboardkepala', KepalaController::class,);
    Route::resource('/barang', BarangController::class);
    Route::resource('/barangkepala', BrgKepalaController::class);
    Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])
        ->name('barang.destroy');
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/pengembalian', PengembalianController::class);

    // tambahan
    Route::resource('/pengajuan', PengajuanController::class);
    Route::resource('/pengajuankepala', PgjKepalaController::class);
    Route::delete('/pengajuan/destroy/{id}', [PengajuanController::class, 'destroy'])
        ->name('pengajuan.destroy');
    Route::patch('/pengajuan/update-status/{id}', [PgjKepalaController::class, 'updateStatus'])
        ->name('pengajuan.updateStatus');

    Route::get('/peminjam/register', [PeminjamController::class, 'create']);
    Route::post('/peminjam/store', [PeminjamController::class, 'store']);
    Route::resource('/peminjam', PeminjamController::class);

    // tambahan cetak
    Route::get('/print-barang', [CetakController::class, 'cetakBarang'])
        ->name('cetakBarang');
    Route::get('/print-peminjaman', [CetakController::class, 'cetakPeminjaman'])
        ->name('cetakPeminjaman');
    Route::get('/print-pengajuan', [CetakController::class, 'cetakPengajuan'])
        ->name('cetakPengajuan');

    // pengembalian
    Route::delete('/pengembalian/destroy/{id}', [PengembalianController::class, 'destroy'])
        ->name('pengembalian.destroy');
    Route::post('/barang', [BarangController::class, 'store']);
});
