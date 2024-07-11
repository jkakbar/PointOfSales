<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('aksilogin');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['role:Admin,Kasir,Pimpinan', 'nocache'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('penjualan', PenjualanController::class);

});

Route::middleware(['role:Admin,Pimpinan', 'nocache'])->group(function () {
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', BarangController::class);

});
Route::middleware(['role:Admin', 'nocache'])->group(function () {
    Route::get('level', [App\Http\Controllers\LevelController::class, 'index'])->name('level');
    Route::resource('user', UserController::class);

});

// This ensures admin cannot access other actions in PesertaController
// Route::middleware(['role:Admin'])->group(function () {
//     Route::get('peserta/{any}', function () {
//         abort(404);
//     })->where('any', '.*');
// });
