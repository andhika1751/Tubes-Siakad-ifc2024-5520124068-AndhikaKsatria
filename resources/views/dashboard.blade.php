@extends('layouts.app')
@section('title', 'Dashboard')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Dashboard</h1>

@if(auth()->user()->isAdmin())
    <div class="stat-grid">
        <div class="stat-card stat-blue">
            <div class="stat-number">{{ $stats['total_dosen'] }}</div>
            <div class="stat-label">Total Dosen</div>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-number">{{ $stats['total_mahasiswa'] }}</div>
            <div class="stat-label">Total Mahasiswa</div>
        </div>
        <div class="stat-card stat-orange">
            <div class="stat-number">{{ $stats['total_matakuliah'] }}</div>
            <div class="stat-label">Total Mata Kuliah</div>
        </div>
        <div class="stat-card stat-purple">
            <div class="stat-number">{{ $stats['total_jadwal'] }}</div>
            <div class="stat-label">Total Jadwal</div>
        </div>
        <div class="stat-card stat-red">
            <div class="stat-number">{{ $stats['total_krs'] }}</div>
            <div class="stat-label">Total KRS Diambil</div>
        </div>
    </div>

    <div class="card" style="margin-top:1.5rem">
        <div class="card-header">5 Mata Kuliah Paling Banyak Diambil</div>
        <table>
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Kode MK</th>
                    <th>Nama Matakuliah</th>
                    <th style="width:120px">Jumlah Diambil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matkulFavorit as $i => $mk)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $mk['kode'] }}</td>
                    <td>{{ $mk['nama'] }}</td>
                    <td>{{ $mk['jumlah'] }} mahasiswa</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:#999;padding:1.5rem;">Belum ada data KRS.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <div class="stat-grid">
        <div class="stat-card stat-blue">
            <div class="stat-number">{{ $stats['total_matkul_diambil'] }}</div>
            <div class="stat-label">Mata Kuliah Diambil</div>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-number">{{ $stats['total_sks'] }}</div>
            <div class="stat-label">Total SKS Diambil</div>
        </div>
    </div>

    <div class="card" style="margin-top:1.5rem">
        <div class="card-header">Mata Kuliah Saya</div>
        <table>
            <thead>
                <tr>
                    <th style="width:50px">No</th>
                    <th>Kode MK</th>
                    <th>Nama Matakuliah</th>
                    <th style="width:55px">SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krsSaya as $i => $krs)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $krs->kode_matakuliah }}</td>
                    <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $krs->matakuliah->sks ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:#999;padding:1.5rem;">Anda belum mengambil mata kuliah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endif
@endsection
