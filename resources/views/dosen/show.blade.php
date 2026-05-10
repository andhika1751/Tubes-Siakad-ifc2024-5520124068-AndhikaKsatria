@extends('layouts.app')
@section('title', 'Detail Dosen')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Detail Dosen</h1>

<div class="card form-max">
    <div class="card-header">Informasi Dosen</div>
    <div class="card-body" style="padding:0">
        <table class="detail-table">
            <tr>
                <td>NIDN</td>
                <td>{{ $dosen->nidn }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $dosen->nama }}</td>
            </tr>
            <tr>
                <td>Jumlah Mahasiswa</td>
                <td>{{ $dosen->mahasiswas->count() }} mahasiswa</td>
            </tr>
            <tr>
                <td>Jumlah Jadwal</td>
                <td>{{ $dosen->jadwals->count() }} jadwal</td>
            </tr>
            <tr>
                <td>Dibuat</td>
                <td>{{ $dosen->created_at->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td>Diperbarui</td>
                <td>{{ $dosen->updated_at->format('d M Y, H:i') }}</td>
            </tr>
        </table>
    </div>
</div>

@if($dosen->mahasiswas->count() > 0)
<div class="card" style="margin-top:1.5rem; max-width:580px">
    <div class="card-header">Daftar Mahasiswa Wali</div>
    <table>
        <thead>
            <tr><th style="width:50px">No</th><th>NPM</th><th>Nama</th></tr>
        </thead>
        <tbody>
            @foreach($dosen->mahasiswas as $i => $mhs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $mhs->npm }}</td>
                <td>{{ $mhs->nama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<div class="btn-group" style="margin-top:1.5rem">
    <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection