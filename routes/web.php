<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard: arahkan otomatis sesuai role setelah login
    Route::get('/dashboard', function () {
        return redirect()->route(auth()->user()->isAdmin() ? 'dosen.index' : 'jadwal.index');
    })->name('dashboard');

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | KHUSUS ADMIN: kelola semua data master
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen',      DosenController::class);
        Route::resource('mahasiswa',  MahasiswaController::class);
        Route::resource('matakuliah', MatakuliahController::class);
        // Admin: kelola jadwal penuh (tambah/edit/hapus), index & show dipisah di bawah
        Route::resource('jadwal', JadwalController::class)->except(['index', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN & MAHASISWA: lihat jadwal
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,mahasiswa')->group(function () {
        Route::resource('jadwal', JadwalController::class)->only(['index', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN & MAHASISWA: lihat KRS
    | (Admin lihat KRS semua mahasiswa, mahasiswa hanya lihat KRS miliknya
    | sendiri — logika filter ada di KrsController)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,mahasiswa')->group(function () {
        Route::resource('krs', KrsController::class)->only(['index', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | KHUSUS MAHASISWA: ambil (create/store) & drop (destroy) mata kuliah
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:mahasiswa')->group(function () {
        Route::resource('krs', KrsController::class)->only(['create', 'store', 'destroy']);
    });
});

require __DIR__.'/auth.php';