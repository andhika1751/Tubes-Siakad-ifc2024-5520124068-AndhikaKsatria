@extends('layouts.app')
@section('title', 'Data KRS')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman KRS</h1>
<a href="{{ route('krs.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

<div class="card">
    <div class="card-header">Daftar KRS</div>
    <table>
        <thead>
            <tr>
                <th style="width:50px">No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode MK</th>
                <th>Nama Matakuliah</th>
                <th style="width:55px">SKS</th>
                <th style="width:185px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krsList as $i => $krs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $krs->npm }}</td>
                <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
                <td>{{ $krs->kode_matakuliah }}</td>
                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $krs->matakuliah->sks ?? '-' }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('krs.destroy', $krs->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus KRS ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('krs.edit', $krs->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('krs.show', $krs->id) }}" class="btn btn-info">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#999;padding:2rem;">Belum ada data KRS.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection