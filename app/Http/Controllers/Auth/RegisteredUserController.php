<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Pendaftaran mandiri DITUTUP untuk SIAKAD ini.
     * Akun mahasiswa dibuat oleh Admin (lewat seeder/data mahasiswa),
     * bukan lewat form register publik.
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('login')
            ->with('error', 'Pendaftaran akun mandiri tidak diperbolehkan. Akun mahasiswa dibuat oleh Admin berdasarkan data mahasiswa. Silakan hubungi Admin/Dosen untuk mendapatkan akun.');
    }

    /**
     * Jaga-jaga kalau ada yang coba submit POST /register langsung.
     */
    public function store(): RedirectResponse
    {
        return redirect()->route('login')
            ->with('error', 'Pendaftaran akun mandiri tidak diperbolehkan. Akun mahasiswa dibuat oleh Admin berdasarkan data mahasiswa. Silakan hubungi Admin/Dosen untuk mendapatkan akun.');
    }
}
