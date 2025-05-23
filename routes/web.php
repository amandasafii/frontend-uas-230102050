<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MatkulController;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kelas', KelasController::class);
Route::resource('prodi', ProdiController::class);
Route::resource('matkul', MatkulController::class);