@extends('layouts.app')
@section('title', 'Data Jadwal')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Halaman Jadwal</h1>
<a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-4">Tambah Data</a>

<div class="card">
    <div class="card-header">Daftar Jadwal</div>
    <table>
        <thead>
            <tr>
                <th style="width:50px">No</th>
                <th>Matakuliah</th>
                <th>Dosen</th>
                <th style="width:65px">Kelas</th>
                <th style="width:90px">Hari</th>
                <th style="width:75px">Jam</th>
                <th style="width:185px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $i => $jadwal)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $jadwal->matakuliah->nama_matakuliah ?? $jadwal->kode_matakuliah }}</td>
                <td>{{ $jadwal->dosen->nama ?? $jadwal->nidn }}</td>
                <td>{{ $jadwal->kelas }}</td>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</td>
                <td>
                    <div class="aksi-cell">
                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('jadwal.show', $jadwal->id) }}" class="btn btn-info">Detail</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#999;padding:2rem;">Belum ada data jadwal.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection