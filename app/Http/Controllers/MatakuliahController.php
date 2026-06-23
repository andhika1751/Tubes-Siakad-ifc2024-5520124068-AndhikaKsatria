<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $matakuliahs = Matakuliah::when($search, function ($q) use ($search) {
        $q->where('kode_matakuliah', 'like', "%{$search}%")
          ->orWhere('nama_matakuliah', 'like', "%{$search}%");
    })
    ->paginate(5)
    ->withQueryString();

    return view('matakuliah.index', compact('matakuliahs'));
}

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|size:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ]);
        Matakuliah::create($request->only('kode_matakuliah', 'nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil ditambahkan!');
    }

    public function show(Matakuliah $matakuliah)
    {
        $matakuliah->load('jadwals.dosen', 'krs.mahasiswa');
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ]);
        $matakuliah->update($request->only('nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil diperbarui!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil dihapus!');
    }
}