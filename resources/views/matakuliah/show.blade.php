@extends('layouts.app')
@section('title', 'Detail Matakuliah')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Detail Matakuliah</h1>

<div class="card form-max">
    <div class="card-header">Informasi Matakuliah</div>
    <div class="card-body" style="padding:0">
        <table class="detail-table">
            <tr><td>Kode</td><td>{{ $matakuliah->kode_matakuliah }}</td></tr>
            <tr><td>Nama Matakuliah</td><td>{{ $matakuliah->nama_matakuliah }}</td></tr>
            <tr><td>SKS</td><td>{{ $matakuliah->sks }} SKS</td></tr>
            <tr><td>Jumlah Jadwal</td><td>{{ $matakuliah->jadwals->count() }} jadwal</td></tr>
            <tr><td>Jumlah Peserta</td><td>{{ $matakuliah->krs->count() }} mahasiswa</td></tr>
            <tr><td>Dibuat</td><td>{{ $matakuliah->created_at->format('d M Y, H:i') }}</td></tr>
            <tr><td>Diperbarui</td><td>{{ $matakuliah->updated_at->format('d M Y, H:i') }}</td></tr>
        </table>
    </div>
</div>

@if($matakuliah->jadwals->count() > 0)
<div class="card" style="margin-top:1.5rem; max-width:580px">
    <div class="card-header">Jadwal Kelas</div>
    <table>
        <thead>
            <tr><th style="width:50px">No</th><th>Dosen</th><th style="width:65px">Kelas</th><th style="width:90px">Hari</th><th style="width:70px">Jam</th></tr>
        </thead>
        <tbody>
            @foreach($matakuliah->jadwals as $i => $j)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $j->dosen->nama ?? $j->nidn }}</td>
                <td>{{ $j->kelas }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@if($matakuliah->krs->count() > 0)
<div class="card" style="margin-top:1.5rem; max-width:580px">
    <div class="card-header">Daftar Mahasiswa Peserta</div>
    <table>
        <thead>
            <tr><th style="width:50px">No</th><th>NPM</th><th>Nama</th></tr>
        </thead>
        <tbody>
            @foreach($matakuliah->krs as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k->mahasiswa->npm ?? '-' }}</td>
                <td>{{ $k->mahasiswa->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<div class="btn-group" style="margin-top:1.5rem">
    <a href="{{ route('matakuliah.edit', $matakuliah->kode_matakuliah) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
