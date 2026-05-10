@extends('layouts.app')
@section('title', 'Detail Jadwal')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Detail Jadwal</h1>

<div class="card form-max">
    <div class="card-header">Informasi Jadwal</div>
    <div class="card-body" style="padding:0">
        <table class="detail-table">
            <tr><td>ID Jadwal</td><td>{{ $jadwal->id }}</td></tr>
            <tr><td>Matakuliah</td><td>{{ $jadwal->matakuliah->nama_matakuliah ?? '-' }} <small style="color:#999">({{ $jadwal->kode_matakuliah }})</small></td></tr>
            <tr><td>SKS</td><td>{{ $jadwal->matakuliah->sks ?? '-' }} SKS</td></tr>
            <tr><td>Dosen</td><td>{{ $jadwal->dosen->nama ?? '-' }} <small style="color:#999">({{ $jadwal->nidn }})</small></td></tr>
            <tr><td>Kelas</td><td>{{ $jadwal->kelas }}</td></tr>
            <tr><td>Hari</td><td>{{ $jadwal->hari }}</td></tr>
            <tr><td>Jam</td><td>{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB</td></tr>
            <tr><td>Dibuat</td><td>{{ $jadwal->created_at->format('d M Y, H:i') }}</td></tr>
            <tr><td>Diperbarui</td><td>{{ $jadwal->updated_at->format('d M Y, H:i') }}</td></tr>
        </table>
    </div>
</div>

<div class="btn-group" style="margin-top:1.5rem">
    <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
