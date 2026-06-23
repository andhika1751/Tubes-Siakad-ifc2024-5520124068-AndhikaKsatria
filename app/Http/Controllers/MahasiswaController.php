<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $mahasiswas = Mahasiswa::with('dosen')
            ->when($search, function ($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('mahasiswa.create', compact('dosens'));
    }

    /**
     * Simpan data mahasiswa BARU + buatkan akun login (role: mahasiswa)
     * memakai email yang diinput admin lewat form.
     * Password akun default = NPM mahasiswa itu sendiri.
     */
    public function store(Request $request)
    {
        $request->validate([
            'npm'   => 'required|string|size:10|unique:mahasiswa,npm',
            'nidn'  => 'required|string|exists:dosen,nidn',
            'nama'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
        ]);

        $mahasiswa = Mahasiswa::create($request->only('npm', 'nidn', 'nama'));

        User::create([
            'name'     => $mahasiswa->nama,
            'email'    => $request->email,
            'password' => Hash::make($mahasiswa->npm),
            'role'     => 'mahasiswa',
            'npm'      => $mahasiswa->npm,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', "Data mahasiswa berhasil ditambahkan! Akun login -> Email: {$request->email}, Password: {$mahasiswa->npm}");
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('dosen', 'krs.matakuliah');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    /**
     * Update data mahasiswa + sinkronkan nama & email di akun login miliknya.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nidn'  => 'required|string|exists:dosen,nidn',
            'nama'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.optional($mahasiswa->user)->id,
        ]);

        $mahasiswa->update($request->only('nidn', 'nama'));

        // Sinkron nama & email di akun login. Kalau akunnya belum ada
        // (data lama sebelum fitur ini ada), otomatis dibuatkan juga,
        // dengan password default = NPM.
        $user = User::firstOrNew(['npm' => $mahasiswa->npm]);
        $isNewUser = ! $user->exists;

        $user->name  = $mahasiswa->nama;
        $user->email = $request->email;
        $user->role  = 'mahasiswa';
        if ($isNewUser) {
            $user->password = Hash::make($mahasiswa->npm);
        }
        $user->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Hapus data mahasiswa. Akun login otomatis ikut terhapus karena
     * foreign key 'npm' di tabel users sudah diset onDelete('cascade').
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa & akun login terkait berhasil dihapus!');
    }
}
