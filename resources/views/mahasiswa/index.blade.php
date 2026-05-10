@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Mahasiswa</h1>
<a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

<div class="card">
    <div class="card-header">Daftar Mahasiswa</div>
    <table>
        <thead>
            <tr>
                <th style="width:60px">No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Dosen Wali</th>
                <th style="width:130px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mhs->npm }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->dosen->nama ?? '-' }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('mahasiswa.destroy', $mhs->npm) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus mahasiswa ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('mahasiswa.edit', $mhs->npm) }}" class="btn btn-warning">Edit</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#999;padding:2rem;">Belum ada data mahasiswa.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
