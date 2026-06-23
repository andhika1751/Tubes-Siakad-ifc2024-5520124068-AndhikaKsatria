@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Mahasiswa</h1>
<a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
<form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-3">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari mahasiswa..."
           style="padding:8px;width:250px;">

    <button type="submit" class="btn btn-primary">
        Cari
    </button>
</form>
<div class="card">
    <div class="card-header">Daftar Mahasiswa</div>
    <table>
        <thead>
            <tr>
                <th style="width:55px">No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Dosen Wali</th>
                <th style="width:185px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $mahasiswas->firstItem() + $i }}</td>
                <td>{{ $mhs->npm }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->dosen->nama ?? '-' }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus mahasiswa {{ $mhs->nama }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('mahasiswa.show', $mhs->npm) }}" class="btn btn-info">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#999;padding:2rem;">Belum ada data mahasiswa.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:20px">
    {{ $mahasiswas->links() }}
</div>
@endsection