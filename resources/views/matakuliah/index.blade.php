@extends('layouts.app')
@section('title', 'Data Matakuliah')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Matakuliah</h1>
<a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

<div class="card">
    <div class="card-header">Daftar Matakuliah</div>
    <table>
        <thead>
            <tr>
                <th style="width:55px">No</th>
                <th>Kode</th>
                <th>Nama Matakuliah</th>
                <th style="width:70px">SKS</th>
                <th style="width:185px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matakuliahs as $i => $mk)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mk->kode_matakuliah }}</td>
                <td>{{ $mk->nama_matakuliah }}</td>
                <td>{{ $mk->sks }}</td>
                <td>
                    <div class="aksi-cell">
                        <button type="button" class="btn btn-disabled" disabled>Hapus</button>
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('matakuliah.show', $mk->kode_matakuliah) }}" class="btn btn-info">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#999;padding:2rem;">Belum ada data matakuliah.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection