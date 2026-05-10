<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $matakuliahs = Matakuliah::all();
        $dosens      = Dosen::all();
        return view('jadwal.create', compact('matakuliahs', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|string|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1',
            'hari'            => 'required|string|max:10',
            'jam'             => 'required|date_format:H:i',
        ]);

        // Simpan jam sebagai timestamp hari ini + jam yg dipilih
        $jamTimestamp = now()->format('Y-m-d') . ' ' . $request->jam . ':00';

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => $request->kelas,
            'hari'            => $request->hari,
            'jam'             => $jamTimestamp,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil ditambahkan!');
    }

    public function edit(Jadwal $jadwal)
    {
        $matakuliahs = Matakuliah::all();
        $dosens      = Dosen::all();
        return view('jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|string|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1',
            'hari'            => 'required|string|max:10',
            'jam'             => 'required|date_format:H:i',
        ]);

        $jamTimestamp = now()->format('Y-m-d') . ' ' . $request->jam . ':00';

        $jadwal->update([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => $request->kelas,
            'hari'            => $request->hari,
            'jam'             => $jamTimestamp,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui!');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus!');
    }
}
