@extends('layouts.app')
@section('title', 'Edit Matakuliah')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Edit Matakuliah</h1>

<div class="card form-max">
    <div class="card-header">Form Edit Data Matakuliah</div>
    <div class="card-body">
        <form action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Kode Matakuliah</label>
                <input type="text" value="{{ $matakuliah->kode_matakuliah }}" disabled
                       style="background:#f0f0f0;color:#888;cursor:not-allowed;">
            </div>

            <div class="form-group">
                <label for="nama_matakuliah">Nama Matakuliah</label>
                <input type="text" id="nama_matakuliah" name="nama_matakuliah"
                       value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}"
                       placeholder="Masukkan nama matakuliah"
                       class="{{ $errors->has('nama_matakuliah') ? 'is-invalid' : '' }}">
                @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" id="sks" name="sks"
                       value="{{ old('sks', $matakuliah->sks) }}"
                       min="1" max="6"
                       class="{{ $errors->has('sks') ? 'is-invalid' : '' }}">
                @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
