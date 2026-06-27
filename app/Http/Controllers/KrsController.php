<?php

namespace App\Http\Controllers;

use App\Exports\KrsExport;
use App\Models\Krs;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class KrsController extends Controller
{
    /**
     * Query dasar KRS sesuai role yang login:
     * - Admin    : semua data KRS
     * - Mahasiswa: hanya KRS miliknya sendiri
     */
    private function baseQuery(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'matakuliah']);

        if ($request->user()->isMahasiswa()) {
            $query->where('npm', $request->user()->npm);
        }

        return $query;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $krsList = $this->baseQuery($request)
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
     * Khusus mahasiswa: simpan KRS untuk npm miliknya sendiri.
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
     * Mahasiswa: hanya lihat detail KRS miliknya sendiri.
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

    /**
     * Export KRS ke PDF. Admin export semua data, mahasiswa export miliknya saja.
     */
    public function exportPdf(Request $request)
    {
        $krsList = $this->baseQuery($request)->get();
        $pdf = Pdf::loadView('krs.pdf', compact('krsList'));
        return $pdf->download('data-krs-'.now()->format('Ymd-His').'.pdf');
    }

    /**
     * Export KRS ke Excel. Admin export semua data, mahasiswa export miliknya saja.
     */
    public function exportExcel(Request $request)
    {
        $krsList = $this->baseQuery($request)->get();
        return Excel::download(new KrsExport($krsList), 'data-krs-'.now()->format('Ymd-His').'.xlsx');
    }
}
