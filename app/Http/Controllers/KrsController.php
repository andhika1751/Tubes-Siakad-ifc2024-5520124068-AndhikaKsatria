<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Admin: lihat KRS semua mahasiswa (bisa cari berdasarkan npm/kode matakuliah).
     * Mahasiswa: hanya lihat KRS miliknya sendiri (bisa cari di dalam KRS miliknya).
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Krs::with(['mahasiswa', 'matakuliah']);

        // Mahasiswa hanya boleh melihat KRS miliknya sendiri
        if ($request->user()->isMahasiswa()) {
            $query->where('npm', $request->user()->npm);
        }

        $krsList = $query
            ->when($search, function ($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                  ->orWhere('kode_matakuliah', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString();

        return view('krs.index', compact('krsList'));
    }

    /**
     * Khusus mahasiswa: form ambil mata kuliah untuk dirinya sendiri.
     */
    public function create()
    {
        $matakuliahs = Matakuliah::all();
        return view('krs.create', compact('matakuliahs'));
    }

    /**
     * Khusus mahasiswa: simpan KRS untuk npm miliknya sendiri (tidak bisa pilih npm lain).
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
        ]);

        $npm = $request->user()->npm;

        $exists = Krs::where('npm', $npm)
                     ->where('kode_matakuliah', $request->kode_matakuliah)->exists();
        if ($exists) {
            return back()->withErrors(['kode_matakuliah' => 'Anda sudah mengambil matakuliah ini!'])->withInput();
        }

        Krs::create([
            'npm'             => $npm,
            'kode_matakuliah' => $request->kode_matakuliah,
        ]);

        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil diambil!');
    }

    /**
     * Admin: lihat detail KRS siapa saja.
     * Mahasiswa: hanya lihat detail KRS miliknya sendiri (403 jika bukan miliknya).
     */
    public function show(Request $request, $id)
    {
        $krs = Krs::with(['mahasiswa.dosen', 'matakuliah'])->findOrFail($id);

        if ($request->user()->isMahasiswa() && $krs->npm !== $request->user()->npm) {
            abort(403, 'Anda tidak memiliki akses ke data KRS ini.');
        }

        return view('krs.show', compact('krs'));
    }

    /**
     * Khusus mahasiswa: drop mata kuliah miliknya sendiri.
     */
    public function destroy(Request $request, $id)
    {
        $krs = Krs::findOrFail($id);

        if ($krs->npm !== $request->user()->npm) {
            abort(403, 'Anda tidak dapat menghapus KRS milik mahasiswa lain.');
        }

        $krs->delete();
        return redirect()->route('krs.index')->with('success', 'Mata kuliah berhasil di-drop!');
    }
}
