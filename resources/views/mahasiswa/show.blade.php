@extends('layouts.app')
@section('title', 'Detail Mahasiswa')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Detail Mahasiswa</h1>

<div class="card form-max">
    <div class="card-header">Informasi Mahasiswa</div>
    <div class="card-body" style="padding:0">
        <table class="detail-table">
            <tr><td>NPM</td><td>{{ $mahasiswa->npm }}</td></tr>
            <tr><td>Nama</td><td>{{ $mahasiswa->nama }}</td></tr>
            <tr><td>Dosen Wali</td><td>{{ $mahasiswa->dosen->nama ?? '-' }} <small style="color:#999">({{ $mahasiswa->nidn }})</small></td></tr>
            <tr><td>Jumlah MK diambil</td><td>{{ $mahasiswa->krs->count() }} matakuliah</td></tr>
            <tr><td>Total SKS</td><td>{{ $mahasiswa->krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }} SKS</td></tr>
            <tr><td>Dibuat</td><td>{{ $mahasiswa->created_at->format('d M Y, H:i') }}</td></tr>
            <tr><td>Diperbarui</td><td>{{ $mahasiswa->updated_at->format('d M Y, H:i') }}</td></tr>
        </table>
    </div>
</div>

@if($mahasiswa->krs->count() > 0)
<div class="card" style="margin-top:1.5rem; max-width:580px">
    <div class="card-header">Matakuliah yang Diambil (KRS)</div>
    <table>
        <thead>
            <tr><th style="width:50px">No</th><th>Kode</th><th>Nama Matakuliah</th><th style="width:60px">SKS</th></tr>
        </thead>
        <tbody>
            @foreach($mahasiswa->krs as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k->kode_matakuliah }}</td>
                <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $k->matakuliah->sks ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<div class="btn-group" style="margin-top:1.5rem">
    <a href="{{ route('mahasiswa.edit', $mahasiswa->npm) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
