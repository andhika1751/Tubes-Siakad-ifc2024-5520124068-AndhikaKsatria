@extends('layouts.app')
@section('title', 'Data Dosen')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Dosen</h1>
<a href="{{ route('dosen.create') }}" class="btn btn-primary mb-4">Tambah Data</a>
<form method="GET" action="{{ route('dosen.index') }}" class="mb-3">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari dosen..."
           style="padding:8px;width:250px;">

    <button type="submit" class="btn btn-primary">
        Cari
    </button>
</form>
<div class="card">
    <div class="card-header">Daftar Dosen</div>
    <table>
        <thead>
            <tr>
                <th style="width:55px">No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th style="width:185px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dosens as $i => $dosen)
            <tr>
                <td>{{ $dosens->firstItem() + $i }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>{{ $dosen->nama }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('dosen.destroy', $dosen->nidn) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus dosen {{ $dosen->nama }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning">Edit</a>
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
<div style="margin-top:20px">
    {{ $dosens->links() }}
</div>
@endsection