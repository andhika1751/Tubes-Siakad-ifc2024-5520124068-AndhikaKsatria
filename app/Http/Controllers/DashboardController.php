<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $stats = [
                'total_dosen'      => Dosen::count(),
                'total_mahasiswa'  => Mahasiswa::count(),
                'total_matakuliah' => Matakuliah::count(),
                'total_jadwal'     => Jadwal::count(),
                'total_krs'        => Krs::count(),
            ];

            // 5 matakuliah paling banyak diambil
            $matkulFavorit = Krs::selectRaw('kode_matakuliah, COUNT(*) as jumlah')
                ->groupBy('kode_matakuliah')
                ->orderByDesc('jumlah')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $mk = Matakuliah::find($item->kode_matakuliah);
                    return [
                        'kode'   => $item->kode_matakuliah,
                        'nama'   => $mk->nama_matakuliah ?? $item->kode_matakuliah,
                        'jumlah' => $item->jumlah,
                    ];
                });

            return view('dashboard', compact('stats', 'matkulFavorit'));
        }

        // Mahasiswa: statistik KRS miliknya sendiri
        $user = $request->user();
        $krsSaya = Krs::with('matakuliah')->where('npm', $user->npm)->get();

        $stats = [
            'total_matkul_diambil' => $krsSaya->count(),
            'total_sks'            => $krsSaya->sum(fn ($k) => $k->matakuliah->sks ?? 0),
        ];

        return view('dashboard', compact('stats', 'krsSaya'));
    }
}
