<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $dosens = Dosen::when($search, function ($q) use ($search) {
        $q->where('nidn', 'like', "%{$search}%")
          ->orWhere('nama', 'like', "%{$search}%");
    })
    ->paginate(5)
    ->withQueryString();

    return view('dosen.index', compact('dosens'));
}

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|size:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ]);
        Dosen::create($request->only('nidn', 'nama'));
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
    }

    public function show(Dosen $dosen)
    {
        $dosen->load('mahasiswas', 'jadwals.matakuliah');
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate(['nama' => 'required|string|max:50']);
        $dosen->update($request->only('nama'));
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui!');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
    }
}