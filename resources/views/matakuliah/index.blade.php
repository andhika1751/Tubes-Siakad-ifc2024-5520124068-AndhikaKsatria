@extends('layouts.app')
@section('title', 'Data Matakuliah')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Matakuliah</h1>
<a href="{{ route('matakuliah.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
<form method="GET" action="{{ route('matakuliah.index') }}" class="mb-3">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari matakuliah..."
           style="padding:8px;width:250px;">

    <button type="submit" class="btn btn-primary">
        Cari
    </button>
</form>
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
                <td>{{ $matakuliahs->firstItem() + $i }}</td>
                <td>{{ $mk->kode_matakuliah }}</td>
                <td>{{ $mk->nama_matakuliah }}</td>
                <td>{{ $mk->sks }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus matakuliah {{ $mk->nama_matakuliah }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
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
<div style="margin-top:20px">
    {{ $matakuliahs->links() }}
</div>
@endsection