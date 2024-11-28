<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]); // Menonaktifkan register

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('kelas', App\Http\Controllers\KelasController::class);
    Route::resource('spp', App\Http\Controllers\SppController::class);
    Route::resource('siswa', App\Http\Controllers\SiswaController::class);
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);

    

});
