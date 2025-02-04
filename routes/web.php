<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\KepalaController;
use App\Http\Controllers\BrgKepalaController;
use App\Http\Controllers\PgjKepalaController;
use Illuminate\Support\Facades\Route;

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
    Route::resource('/dashboard', DashboardController::class)->only('index');
    Route::resource('/dashboardkepala', KepalaController::class)->only('index');
    Route::get('/barang/detail/{code}', [BarangController::class, 'code'])
        ->name('barang.code');
    Route::get('/barang/detail/{code}/edit', [BarangController::class, 'bulkEdit'])
        ->name('barang.bulk-code-edit');
    Route::put('/barang/detail/{code}', [BarangController::class, 'bulkUpdate'])
        ->name('barang.bulk-code-update');
    Route::resource('/barang', BarangController::class)->except('show', 'edit');
    Route::get('/barangkepala/detail/{code}', [BrgKepalaController::class, 'code'])
        ->name('barangkepala.code');
    Route::resource('/barangkepala', BrgKepalaController::class)->only('index');
    Route::resource('/peminjaman', PeminjamanController::class)->except('show');
    Route::resource('/pengembalian', PengembalianController::class)->only('destroy');

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
});
