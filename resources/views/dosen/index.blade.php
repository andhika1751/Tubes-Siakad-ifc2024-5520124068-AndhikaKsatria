@extends('layouts.app')
@section('title', 'Data Dosen')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Dosen</h1>
<a href="{{ route('dosen.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

<div class="card">
    <div class="card-header">Daftar Dosen</div>
    <table>
        <thead>
            <tr>
                <th style="width:60px">No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th style="width:160px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dosens as $i => $dosen)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->nama }}</td>
                <td>
                    <div class="aksi-cell">
                        {{-- Hapus: non-aktif --}}
                        <button type="button" class="btn btn-disabled" disabled>Hapus</button>
                        {{-- Edit --}}
                        <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning">Edit</a>
                        {{-- Detail --}}
                        <a href="{{ route('dosen.show', $dosen->nidn) }}" class="btn btn-info">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;color:#999;padding:2rem;">Belum ada data dosen.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection