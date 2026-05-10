<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $krsList = Krs::with(['mahasiswa', 'matakuliah'])->get();
        return view('krs.index', compact('krsList'));
    }

    public function create()
    {
        $mahasiswas  = Mahasiswa::all();
        $matakuliahs = Matakuliah::all();
        return view('krs.create', compact('mahasiswas', 'matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'             => 'required|string|exists:mahasiswa,npm',
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
        ]);

        // Cek duplikasi
        $exists = Krs::where('npm', $request->npm)
                     ->where('kode_matakuliah', $request->kode_matakuliah)
                     ->exists();

        if ($exists) {
            return back()->withErrors(['kode_matakuliah' => 'Mahasiswa sudah mengambil matakuliah ini!'])->withInput();
        }

        Krs::create($request->only('npm', 'kode_matakuliah'));

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil ditambahkan!');
    }

    public function edit(Krs $krs)
    {
        $mahasiswas  = Mahasiswa::all();
        $matakuliahs = Matakuliah::all();
        return view('krs.edit', compact('krs', 'mahasiswas', 'matakuliahs'));
    }

    public function update(Request $request, Krs $krs)
    {
        $request->validate([
            'npm'             => 'required|string|exists:mahasiswa,npm',
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
        ]);

        $exists = Krs::where('npm', $request->npm)
                     ->where('kode_matakuliah', $request->kode_matakuliah)
                     ->where('id', '!=', $krs->id)
                     ->exists();

        if ($exists) {
            return back()->withErrors(['kode_matakuliah' => 'Mahasiswa sudah mengambil matakuliah ini!'])->withInput();
        }

        $krs->update($request->only('npm', 'kode_matakuliah'));

        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil diperbarui!');
    }

    public function destroy(Krs $krs)
    {
        $krs->delete();
        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus!');
    }
}
