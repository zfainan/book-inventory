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
Route::get('/', [SessionController::class, 'index'])->middleware('isTamu');
Route::get('/sesi', [SessionController::class, 'index'])->middleware('isTamu');
Route::get('/sesi/logout', [SessionController::class, 'logout']);
Route::post('/sesi/login', [SessionController::class, 'login'])->middleware('isTamu');

Route::resource('/dashboard', DashboardController::class)->middleware('isLogin');
Route::resource('/dashboardkepala', KepalaController::class,)->middleware('isLogin');
Route::resource('/barang', BarangController::class)->middleware('isLogin');
Route::resource('/barangkepala', BrgKepalaController::class)->middleware('isLogin');
Route::delete('barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::resource('/peminjaman', PeminjamanController::class)->middleware('isLogin');
Route::resource('/pengembalian', PengembalianController::class)->middleware('isLogin');
//tambahan
Route::resource('/pengajuan', PengajuanController::class)->middleware('isLogin');
Route::resource('/pengajuankepala', PgjKepalaController::class)->middleware('isLogin');
Route::delete('/pengajuan/destroy/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
Route::patch('/pengajuan/update-status/{id}', [PgjKepalaController::class, 'updateStatus'])->name('pengajuan.updateStatus');






Route::get('/peminjam/register',[PeminjamController::class, 'create'])->middleware('isLogin');
Route::post('/peminjam/store',[PeminjamController::class, 'store'])->middleware('isLogin');
Route::resource('/peminjam', PeminjamController::class)->middleware('isLogin');

//tambahan cetak
Route::get('/print-barang', [CetakController::class, 'cetakBarang'])->middleware('isLogin')->name('cetakBarang');
Route::get('/print-peminjaman', [CetakController::class, 'cetakPeminjaman'])->middleware('isLogin')->name('cetakPeminjaman');
Route::get('/print-pengajuan', [CetakController::class, 'cetakPengajuan'])->middleware('isLogin')->name('cetakPengajuan');

//pengembalian
Route::delete('/pengembalian/destroy/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
Route::post('/barang', [BarangController::class, 'store']);





